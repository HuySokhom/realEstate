<?php

namespace OSC\District;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('district', 'd');
		$this->idField = 'd.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("d.id = '" . (int)$arg. "' ");
	}

	public function filterByProvinceId( $arg ){
		$this->addWhere("d.province_id = '" . (int)$arg. "' ");
	}

	public function filterByName( $arg ){
		$this->addWhere("d.name_en LIKE '%" . $arg. "%' ");
	}


}
