<?php

namespace OSC\PopularSearch;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\NewsDescription\Collection as NewDescriptionCol
;

class Object extends DbObj {

	protected
		$name,
		$locationId
	;

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name',
				'location_id'
			)
		);
		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				name,
				location_id,
				create_by,
				create_date
			FROM
				search_location
			WHERE
				id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: search location not found",
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
				search_location
			SET 
				name = '" .  $this->getName() . "',
				location_id = '" .  $this->getLocationId() . "',
				update_by = '" .  $this->getUpdateBy() . "'
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
				search_location
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				search_location
			(
				name,
				location_id,
				create_by,
				create_date
			)
				VALUES
			(
				'" . $this->getName() . "',
				'" . $this->getLocationId() . "',
				'" . $this->getCreateBy() . "',
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setName( $string ){
		$this->name = $string;
	}

	public function getName(){
		return $this->name;
	}

	public function setLocationId( $string ){
		$this->locationId = (int)$string;
	}

	public function getLocationId(){
		return $this->locationId;
	}

}
