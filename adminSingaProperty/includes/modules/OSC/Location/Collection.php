<?php

namespace OSC\Location;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('location', 'l');
		$this->idField = 'l.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("l.id = '" . (int)$arg. "' ");
	}

	public function filterByName( $arg ){
		$this->addWhere("l.name LIKE '%" . $arg. "%' ");
	}

}
