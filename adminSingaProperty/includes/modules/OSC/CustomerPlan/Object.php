<?php

namespace OSC\CustomerPlan;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\CustomerSample\Collection as CustomerCol
;

class Object extends DbObj {
		
	protected
		$customersId
		, $plan
		, $planDate
		, $planExpire
		, $detail
	;

	public function __construct( $params = array() ){
		parent::__construct($params);

		$this->detail = new CustomerCol();
	}

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'plan',
				'plan_date',
				'plan_expire',
				'detail',
				'status',
				'create_date'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				customers_id,
				plan,
				plan_date,
				plan_expire,
				status,
				create_date
			FROM
				customers_plan
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Customer Plan not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

		$this->detail->setFilter('id', $this->getCustomersId());
		$this->detail->populate();
	}
	public function update() {
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				customers_plan
			SET
				plan = '" .  $this->getPlan() . "',
				plan_date = NOW(),
				plan_expire = DATE_SUB(NOW(), INTERVAL 31 DAY),
				update_by = '" .  $this->getUpdateBy() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function updateStatus() {
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}

		if($this->getStatus() == 1){
			$numberLimit = 0;
			if($this->getPlan() == 1){
				$numberLimit = 20;
			}
			if($this->getPlan() == 2){
				$numberLimit = 50;
			}
			if($this->getPlan() == 3){
				$numberLimit = 120;
			}
			//	update customer plan table
			$this->dbQuery("
				UPDATE
					customers
				SET
					customers_plan = '" .  $this->getPlan() . "',
					plan_date = NOW(),
					plan_expire = DATE_ADD(NOW(), INTERVAL 31 DAY),
					customers_limit_products = " . $numberLimit . ",
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					customers_id = '" . (int)$this->getCustomersId() . "'
			");
			$this->dbQuery("
				UPDATE
					customers_plan
				SET
					status = '" .  $this->getStatus() . "',
					plan_date = NOW(),
					plan_expire = DATE_ADD(NOW(), INTERVAL 31 DAY),
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					id = '" . (int)$this->getId() . "'
			");
		}else{

			$this->dbQuery("
				UPDATE
					customers_plan
				SET
					status = '" .  $this->getStatus() . "',
					plan_date = '',
					plan_expire = '',
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					id = '" . (int)$this->getId() . "'
			");
			//	update customer plan table
			$this->dbQuery("
				UPDATE
					customers
				SET
					customers_plan = 0,
					plan_date = '',
					plan_expire = '',
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					customers_id = '" . (int)$this->getCustomersId() . "'
			");
			//	update customer plan table
			$this->dbQuery("
				UPDATE
					products
				SET
					products_promote = 0,
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					customers_id = '" . (int)$this->getCustomersId() . "'
			");
		}

	}

	public function delete(){
		if( !$this->getId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				customers_plan
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				customers_plan
			(
				customers_id,
				plan,
				plan_date,
				plan_expire,
				status,
				create_date
			)
				VALUES
			(
				'" . $this->getCustomersId() . "',
				'" . $this->getPlan() . "',
				NOW(),
				DATE_ADD(NOW(), INTERVAL 31 DAY),
				0,
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setDetail( $string ){
		$this->detail = $string;
	}

	public function getDetail(){
		return $this->detail;
	}

	public function setCustomersId( $string ){
		$this->customersId = (int)$string;
	}
	
	public function getCustomersId(){
		return $this->customersId;
	}

	public function setPlan( $string ){
		$this->plan = (int)$string;
	}
	public function getPlan(){
		return $this->plan;
	}

	public function setPlanExpire( $string ){
		$this->planExpire = date('Y-m-d', strtotime( $string ));
	}
	public function getPlanExpire(){
		return $this->planExpire;
	}

	public function setPlanDate( $string ){
		$this->planDate = date('Y-m-d', strtotime( $string ));
	}
	public function getPlanDate(){
		return $this->planDate;
	}

}
