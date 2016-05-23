<?php

namespace OSC\Vehicles\Model;

use OSC;
use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\Vehicles\Brand\Collection as VehicleBrandCol
;

class Object extends DbObj {
		
	protected
		$name
		, $vehicleBrandId
		, $brand
	;
	
	public function __construct( $params = array() ){
		parent::__construct($params);	
		$this->brand = new VehicleBrandCol;
	}
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name',
				'brand'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				id,
				name,
				vehicle_brand_id
			FROM
				vehicle_model
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Vehicle Model not found",
				404
			);
		}
		$this->setProperties($this->dbFetchArray($q));
		$this->brand->setFilter('id', $this->getVehicleBrandId() );
		$this->brand->populate();
		
	}
	
	public function delete(){
		if( !$this->getId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				vehicle_model
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
				vehicle_model
			SET
				name = '" . $this->dbEscape( $this->getName() ) . "',
				vehicle_brand_id = '" . (int)$this->getVehicleBrandId() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				vehicle_model
			(
				name,
				vehicle_brand_id,
				created
			)
				VALUES
			(
				'" . $this->dbEscape( $this->getName() ) . "',
				'" . (int)$this->getVehicleBrandId() . "',
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
	
	public function setVehicleBrandId( $string ){
		$this->vehicleBrandId = (string)$string;
	}
	
	public function getVehicleBrandId(){
		return $this->vehicleBrandId;
	}
	
	public function getBrand(){
		return $this->brand;
	}

	public function setBrand( $string ){
		$this->brand = $string;
	}
	
}
