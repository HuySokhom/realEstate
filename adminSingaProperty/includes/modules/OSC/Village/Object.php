<?php

namespace OSC\Village;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$nameEn
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name_en',
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				name_en
			FROM
				village
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Village not found",
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
				village
			SET
				name_en = '" .  $this->getNameEn() . "'
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
				village
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				village
			(
				name_eb,
				create_date
			)
				VALUES
			(
				'" . $this->getNameEn() . "',
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setName( $string ){
		$this->nameEn = (string)$string;
	}
	
	public function getNameEn(){
		return $this->nameEn;
	}
	
}
