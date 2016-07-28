<?php

namespace OSC\CustomerPlanUpgrade;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$customersId
		, $plan
	;

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'customers_id',
				'plan',
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				customers_id,
				plan
				status,
				create_date
			FROM
				customers_plan
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
		$this->dbQuery("
			UPDATE
				customers_plan_upgrade
			SET
				status = '" .  $this->getStatus() . "',
				update_by = '" . $this->getUpdateBy() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
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
