<?php

namespace OSC\Manufacturers;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$manufacturersName
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'manufacturers_name',
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				manufacturers_name
			FROM
				manufacturers
			WHERE
				manufacturers_id = '" . (int)$this->getId() . "'
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Manufacturers not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
		
	}
	
	public function setManufacturersName( $string ){
		$this->manufacturersName = (string)$string;
	}
	
	public function getManufacturersName(){
		return $this->manufacturersName;
	}
	
}
