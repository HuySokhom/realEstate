<?php

namespace OSC\ProductBrand;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$categoriesBrandId
		, $productsId
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'categories_brand_id',
				'product_id'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				categories_brand_id,
				products_id
			FROM
				products_brand
			WHERE
				id = '" . (int)$this->getId() . "'	
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Product Brand not found",
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
				products_brand
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
				products_brand
			SET
				categories_brand_id = '" . $this->dbEscape( $this->getCategoriesBrandId() ) . "'
			WHERE
				products_id = '" . (int)$this->getId() . "'
		");
	}
	
	public function insert()
	{
		$this->dbQuery("
			INSERT INTO
				products_brand
			(
				categories_brand_id,
				products_id,
				created
			)
				VALUES
			(
				'" . (int)$this->getCategoriesBrandId() . "',
				'" . (int)$this->getProductsId() . "',
				NOW()
			)
		");
		$this->setId($this->dbInsertId());
	}

	public function setCategoriesBrandId( $string ){
		$this->categoriesBrandId = (int)$string;
	}

	public function getCategoriesBrandId(){
		return $this->categoriesBrandId;
	}

	public function setProductsId( $string ){
		$this->productsId = (int)$string;
	}
	
	public function getProductsId(){
		return $this->productsId;
	}
	
}
