<?php

namespace OSC\Categories;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$categoriesId
		, $sortOrder
		, $parentId
		, $categoriesImage
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'categories_image',
				'sort_order',
				'parent_id',
				'categories_id'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				categories_id,
				sort_order,
				parent_id
			FROM
				categories
			WHERE
				categories_id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Categories not found",
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
				categories
			WHERE
				categories_id = '" . (int)$this->getId() . "'
		");
	}

	public function update(){
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}		
		$this->dbQuery("
			UPDATE
				categories
			SET
				parent_id = '" . $this->dbEscape( $this->getParentId() ) . "',
				sort_order = '" . $this->dbEscape( $this->getSortOrder() ) . "',
				categories_image = '" . $this->dbEscape( $this->getCategoriesImage() ) . "'
			WHERE
				categories_id = '" . (int)$this->getId() . "'
		");
	}
	
	public function insert()
	{
		$this->dbQuery("
			INSERT INTO
				categories_brand
			(
				parent_id,
				categories_image,
				sort_order,
				date_added
			)
				VALUES
			(
				'" . $this->getParentId() . "',
				'" . $this->getCategoriesImage() . "',
				'" . $this->getSortOrder() . "',
				NOW()
			)
		");
		$this->setId($this->dbInsertId());
	}

	public function setCategoriesId( $string ){
		$this->categoriesId = (int)$string;
	}

	public function getCategoriesId(){
		return $this->categoriesId;
	}

	public function setSortOrder( $string ){
		$this->sortOrder = $string;
	}
	
	public function getSortOrder(){
		return $this->sortOrder;
	}

	public function setParentId( $string ){
		$this->parentId = $string;
	}

	public function getParentId(){
		return $this->parentId;
	}

	public function setCategoriesImage( $string ){
		$this->categoriesImage = $string;
	}

	public function getCategoriesImage(){
		return $this->categoriesImage;
	}

}
