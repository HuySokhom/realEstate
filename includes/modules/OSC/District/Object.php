<?php

namespace OSC\District;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\Location\Collection as ProvinceCol
;

class Object extends DbObj {
		
	protected
		$nameEn
		, $provinceId
		, $detail
	;

	public function __construct( $params = array() ){
		parent::__construct($params);
		$this->detail = new ProvinceCol();
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
				province_id
			FROM
				district
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: District not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

//		$this->detail->setFilter('id', $this->getProvinceId());
//		$this->detail->populate();
	}

	public function setNameEn( $string ){
		$this->nameEn = (string)$string;
	}
	
	public function getNameEn(){
		return $this->nameEn;
	}

	public function setDetail( $string ){
		$this->detail = (string)$string;
	}
	public function getDetail(){
		return $this->detail;
	}

	public function setProvinceId( $string ){
		$this->provinceId = (int)$string;
	}
	public function getProvinceId(){
		return $this->provinceId;
	}

}
