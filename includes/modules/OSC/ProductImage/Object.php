<?php

namespace OSC\ProductImage;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$image
		, $imageThumbnail
		, $productsId
		, $sortOrder
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'image',
				'image_thumbnail',
				'sort_order'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				products_id,
				image,
				image_thumbnail,
				sort_order
			FROM
				products_images
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Products Image not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
		
	}

	public function delete(){
		if( !$this->getProductsId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				products_images
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function update(){
		$this->dbQuery("
			UPDATE
				products_images
			SET
 				image = '" . $this->dbEscape( $this->getImage() ) . "',
 				image_thumbnail = '" . $this->dbEscape( $this->getImageThumbnail() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");

	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				products_images
			(
				image,
				image_thumbnail,
				products_id
			)
				VALUES
			(
				'" . $this->dbEscape( $this->getImage() ) . "',
				'" . $this->dbEscape( $this->getImageThumbnail() ) . "',
				'" . (int)$this->getProductsId() . "'
			)
		");
		$this->setProductsId( $this->dbInsertId() );
	}

	public function setProductsId( $string ){
		$this->productsId = (string)$string;
	}

	public function getProductsId()
	{
		return $this->productsId;
	}

	public function setImage( $string ){
		$this->image = (string)$string;
	}
	
	public function getImage(){
		return $this->image;
	}

	public function setSortOrder( $string ){
		$this->sortOrder = (string)$string;
	}

	public function getSortOrder(){
		return $this->sortOrder;
	}

	public function setImageThumbnail( $string ){
		$this->imageThumbnail = (string)$string;
	}

	public function getImageThumbnail(){
		return $this->imageThumbnail;
	}
	
}
