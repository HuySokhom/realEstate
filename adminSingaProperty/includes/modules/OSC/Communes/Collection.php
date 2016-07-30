<?php

namespace OSC\Communes;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('communes', 'cm');
		$this->idField = 'cm.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("cm.id = '" . (int)$arg. "' ");
	}

	public function orderById($arg){
		$this->addOrderBy('cm.id', $arg);
	}

	public function filterByDistrictId( $arg ){
		$this->addWhere("cm.district_id = '" . (int)$arg. "' ");
	}

	public function filterByName( $arg ){
		$this->addWhere("cm.name_en LIKE '%" . $arg. "%' ");
	}

}
