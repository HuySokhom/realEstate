<?php

namespace OSC\CustomerPlanUpgrade;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\CustomerSample\Collection as CustomerCol
;

class Object extends DbObj {
		
	protected
		$customersId
		, $plan
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
				'customers_id',
				'plan',
				'create_date',
				'status',
				'detail'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				customers_id,
				plan,
				status,
				create_date
			FROM
				customers_plan_upgrade
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Customer Plan Upgrade not found",
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
				customers_plan_upgrade
			SET
				plan = '" .  $this->getPlan() . "',
				create_date = NOW()
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
					customers_limit_products = " . $numberLimit . ",
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					customers_id = '" . (int)$this->getCustomersId() . "'
			");
			$this->dbQuery("
				UPDATE
					customers_plan_upgrade
				SET
					status = '" .  $this->getStatus() . "',
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					id = '" . (int)$this->getId() . "'
			");
		}else{

			$this->dbQuery("
				UPDATE
					customers_plan_upgrade
				SET
					status = '" .  $this->getStatus() . "',
					update_by = '" . $this->getUpdateBy() . "'
				WHERE
					id = '" . (int)$this->getId() . "'
			");

			$q = $this->dbQuery("
				SELECT
					customers_id,
					plan
				FROM
					customers_plan
				WHERE
					customers_id = '" . (int)$this->getCustomersId() . "'
			");
			$changePlan = $this->dbFetchArray($q);
			$getPlan = (int)$changePlan['plan'];
			$numberLimit = 0;
			if( $getPlan == 1){
				$numberLimit = 20;
			}
			if( $getPlan == 2){
				$numberLimit = 50;
			}
			if( $getPlan == 3){
				$numberLimit = 120;
			}
			//	update customer plan table
			$this->dbQuery("
				UPDATE
					customers
				SET
					customers_plan = " . $changePlan['plan'] . ",
					customers_limit_products = " . $numberLimit . ",
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
				customers_plan_upgrade
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				customers_plan_upgrade
			(
				customers_id,
				plan,
				status,
				create_date
			)
				VALUES
			(
				'" . $this->getCustomersId() . "',
				'" . $this->getPlan() . "',
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

}
