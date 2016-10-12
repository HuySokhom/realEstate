<?php

namespace OSC\PlanPrice;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$planName
		, $limitProduct
		, $price
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'plan_name',
				'limit_product',
				'price',
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				plan_name,
				limit_product,
				price
			FROM
				plan_price
			WHERE
				id = '" . (int)$this->getId() . "'	
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Plan Price not found",
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
				plan_price
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
				plan_price
			SET
				plan_name = '" . $this->dbEscape( $this->getPlanName() ) . "',
				price = '" . $this->dbEscape( $this->getPrice() ) . "',
				limit_product = '" . $this->dbEscape( $this->getLimitProduct() ) . "',
				update_by = '" . $this->dbEscape( $this->getUpdateBy() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");		
	}
	
	public function updateStatus(){
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}		
		$this->dbQuery("
			UPDATE
				plan_price
			SET
				status = '" . $this->getStatus() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");		
	}


	public function setPlanName( $string ){
		$this->planName = (string)$string;
	}

	public function getPlanName(){
		return $this->planName;
	}

	public function setPrice( $string ){
		$this->price = $string;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setLimitProduct( $string ){
		$this->limitProduct = $string;
	}

	public function getLimitProduct(){
		return $this->limitProduct;
	}

	
}
