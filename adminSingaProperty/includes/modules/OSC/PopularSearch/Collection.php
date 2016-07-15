<?php

namespace OSC\PopularSearch;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('search_location', 'sl');
		$this->idField = 'sl.id';
		$this->setDistinct(true);		
		$this->objectType = __NAMESPACE__ . '\Object';	
	}

	public function filterById( $arg ){
		$this->addWhere("sl.id = '" . (int)$arg. "' ");
	}

	public function filterByName( $arg ){
		$this->addWhere("sl.name LIKE '%" . $arg. "%' ");
	}

}
