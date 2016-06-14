<?php

namespace OSC\ProductToCategory;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$categoriesId
		, $productsId
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'categories_id',
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				categories_id
			FROM
				products_to_categories
			WHERE
				products_id = '" . (int)$this->getId() . "'
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Products To Category not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
		
	}

	public function update(){
		$this->dbQuery("
			UPDATE
				products_to_categories
			SET
 				categories_id = '" . $this->getCategoriesId() . "'
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");

	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				products_to_categories
			(
				categories_id,
				products_id
			)
				VALUES
			(
				'" . (int)$this->getCategoriesId() . "',
				'" . (int)$this->getProductsId() . "'
			)
		");
//		$this->setProductsId( $this->dbInsertId() );
	}

	public function setProductsId( $string ){
		$this->productsId = (string)$string;
	}

	public function getProductsId()
	{
		return $this->productsId;
	}

	public function setCategoriesId( $string ){
		$this->categoriesId = (string)$string;
	}
	
	public function getCategoriesId(){
		return $this->categoriesId;
	}
	
}
