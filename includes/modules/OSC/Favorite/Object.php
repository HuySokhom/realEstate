<?php

namespace OSC\Favorite;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$productName
		, $productId
		, $productDescription
		, $productImage
		, $productImageThumbnail
		, $productPrice
		, $sessionId
	;


	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'product_id',
				'product_name',
				'product_price'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				product_name,
				product_id,
				product_price,
				product_description,
				product_image,
				product_image_thumbnail
			FROM
				favorite
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Favorite not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				favorite
			(
				product_id,
				product_name,
				product_description,
				product_price,
				product_image,
				product_image_thumbnail
			)
				VALUES
			(
				'" . $this->getProductId() . "',
				'" . $this->getProductName() . "',
				'" . $this->getProductDescription() . "',
				'" . $this->getProductPrice() . "',
				'" . $this->getProductImage() . "',
				'" . $this->getProductImageThumbnail() . "'
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setProductDescription( $string ){
		$this->productDescription = (string)$string;
	}
	
	public function getProductDescription(){
		return $this->productDescription;
	}

	public function setProductId( $string ){
		$this->productId = (int)$string;
	}
	public function getProductId(){
		return $this->productId;
	}

	public function setProductImage( $string ){
		$this->productImage = $string;
	}
	public function getProductImage(){
		return $this->productImage;
	}

	public function setProductImageThumbnail( $string ){
		$this->productImageThumbnail = $string;
	}
	public function getProductImageThumbnail(){
		return $this->productImageThumbnail;
	}

	public function setProductName( $string ){
		$this->productName = $string;
	}
	public function getProductName(){
		return $this->productName;
	}

	public function setProductPrice( $string ){
		$this->productPrice = $string;
	}
	public function getProductPrice(){
		return $this->productPrice;
	}
}
