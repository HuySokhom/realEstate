<?php

namespace OSC\Communes;

use
	Aedea\Core\Database\StdObject as DbObj,
	OSC\District\Collection as DistrictCol
;

class Object extends DbObj {
		
	protected
		$nameEn
		, $districtId
		, $detail
	;

	public function __construct( $params = array() ){
		parent::__construct($params);
		$this->detail = new DistrictCol();
	}

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name_en',
				'detail'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				name_en,
				district_id
			FROM
				communes
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
		$this->detail->setFilter('id', $this->getDistrictId());
		$this->detail->populate();
	}

	public function update() {
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				communes
			SET
				name_en = '" .  $this->getNameEn() . "',
				district_id = '" .  $this->getDistrictId() . "'
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
				communes
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				communes
			(
				name_en,
				district_id,
				create_date
			)
				VALUES
			(
				'" . $this->getNameEn() . "',
				'" . $this->getDistrictId() . "',
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setNameEn( $string ){
		$this->nameEn = (string)$string;
	}
	
	public function getNameEn(){
		return $this->nameEn;
	}

	public function setDistrictId( $string ){
		$this->districtId = (string)$string;
	}

	public function getDistrictId(){
		return $this->districtId;
	}

	public function setDetail( $string ){
		$this->detail = (string)$string;
	}

	public function getDetail(){
		return $this->detail;
	}

}
