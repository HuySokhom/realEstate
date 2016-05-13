<?php

namespace OSC\Vehicles\Type;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$name
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				id,
				name
			FROM
				vehicle_type
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Vehicle Type not found",
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
				vehicle_type
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
				vehicle_type
			SET
				name = '" . $this->dbEscape( $this->getName() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				vehicle_type
			(
				name,
				created
			)
				VALUES
			(
				'" . $this->dbEscape( $this->getName() ) . "',
				NOW()
			)
		");	
		$this->setId( $this->dbInsertId() );
	}
	
	public function setName( $string ){
		$this->name = (string)$string;
	}
	
	public function getName(){
		return $this->name;
	}
	
}
