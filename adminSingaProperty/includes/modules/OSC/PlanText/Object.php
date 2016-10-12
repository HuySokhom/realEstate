<?php

namespace OSC\PlanText;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$planText
		, $standardInfo
		, $silverInfo
		, $goldInfo
		, $sortOrder
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'plan_text',
				'standard_info',
				'silver_info',
				'gold_info',
				'sort_order'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				plan_text,
				standard_info,
				silver_info,
				gold_info,
				sort_order
			FROM
				plan_text
			WHERE
				id = '" . (int)$this->getId() . "'	
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Plan Text not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
	}
	
	public function delete(){
		if( !$this->getId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				plan_text
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function update(){
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}		
		$this->dbQuery("
			UPDATE
				plan_text
			SET
				plan_text = '" . $this->dbEscape( $this->getPlanText() ) . "',
				standard_info = '" . $this->dbEscape( $this->getStandardInfo() ) . "',
				silver_info = '" . $this->dbEscape( $this->getSilverInfo() ) . "',
				gold_info = '" . $this->dbEscape( $this->getGoldInfo() ) . "',
				sort_order = '" . $this->dbEscape( $this->getSortOrder() ) . "',
				update_by = '" . $this->dbEscape( $this->getUpdateBy() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");		
	}

	public function insert()
	{
		$this->dbQuery("
			INSERT INTO
				plan_text
			(
				plan_text,
				standard_info,
				silver_info,
				gold_info,
				sort_order,
				create_date,
				create_by
			)
				VALUES
			(
				'" . $this->dbEscape($this->getPlanText()) . "',
				'" . $this->dbEscape($this->getStandardInfo()) . "',
				'" . $this->dbEscape($this->getSilverInfo()) . "',
				'" . $this->dbEscape($this->getGoldInfo()) . "',
				'" . (int)$this->getSortOrder() . "',
				NOW(),
				'" . (int)$this->getCreateBy() . "',
			)
		");
		$this->setId($this->dbInsertId());
	}

	public function updateStatus(){
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}		
		$this->dbQuery("
			UPDATE
				plan_text
			SET
				status = '" . $this->getStatus() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");		
	}


	public function setPlanText( $string ){
		$this->planText = (string)$string;
	}

	public function getPlanText(){
		return $this->planText;
	}

	public function setStandardInfo( $string ){
		$this->standardInfo = $string;
	}

	public function getStandardInfo(){
		return $this->standardInfo;
	}

	public function setSilverInfo( $string ){
		$this->silverInfo = $string;
	}

	public function getSilverInfo(){
		return $this->silverInfo;
	}

	public function setGoldInfo( $string ){
		$this->goldInfo = $string;
	}

	public function getGoldInfo(){
		return $this->goldInfo;
	}

	public function setSortOrder( $string ){
		$this->sortOrder = $string;
	}

	public function getSortOrder(){
		return $this->sortOrder;
	}
}
