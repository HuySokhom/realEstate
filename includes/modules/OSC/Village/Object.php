<?php

namespace OSC\Village;

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
//				'detail'
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
//		$this->detail->setFilter('id', $this->getDistrictId());
//		$this->detail->populate();
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
