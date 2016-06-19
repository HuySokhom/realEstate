<?php

namespace OSC\ProductToCategory;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\ProductDescription\Collection
		as ProductDescriptionCol
;

class Object extends DbObj {
		
	protected
		$categoriesId
		, $productsId
		 , $productDetail
	;

	public function __construct( $params = array() ){
		parent::__construct($params);
		$this->productDetail = new ProductDescriptionCol();
	}

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'categories_id',
				'products_id',
				'product_detail'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				categories_id,
				products_id
			FROM
				products_to_categories
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Products To Category not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
		$this->productDetail->setFilter('id', $this->getProductsId());
		$this->productDetail->populate();
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
		$this->setId( $this->dbInsertId() );
	}

	public function setProductsId( $string ){
		$this->productsId = (int)$string;
	}

	public function getProductsId()
	{
		return $this->productsId;
	}

	public function setCategoriesId( $string ){
		$this->categoriesId = (int)$string;
	}
	
	public function getCategoriesId(){
		return $this->categoriesId;
	}

	public function setProductDetail( $string ){
		$this->productDetail = (string)$string;
	}

	public function getProductDetail(){
		return $this->productDetail;
	}
}
