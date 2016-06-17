<?php

namespace OSC\Categories;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('categories', 'c');
		$this->idField = 'c.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function sortByOrder($arg){
		$this->addOrderBy('c.sort_order', $arg);
	}
}
