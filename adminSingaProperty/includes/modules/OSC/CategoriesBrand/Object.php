<?php

namespace OSC\CategoriesBrand;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$categoriesId
		, $name
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name',
				'categories_id'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				categories_id,
				name
			FROM
				categories_brand
			WHERE
				id = '" . (int)$this->getId() . "'	
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Categories Brand not found",
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
				categories_brand
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
				categories_brand
			SET
				name = '" . $this->dbEscape( $this->getName() ) . "',
				categories_id = '" . $this->dbEscape( $this->getCategoriesId() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}
	
	public function insert()
	{
		$this->dbQuery("
			INSERT INTO
				categories_brand
			(
				name,
				categories_id,
				status,
				created
			)
				VALUES
			(
				'" . $this->dbEscape($this->getName()) . "',
				'" . (int)$this->getCategoriesId() . "',
				1,
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

	public function setName( $string ){
		$this->name = (string)$string;
	}
	
	public function getName(){
		return $this->name;
	}
	
}
