<?php

namespace OSC\Advertisement;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('advertising_banner', 'ab');
		$this->idField = 'ab.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function sortByOrder($arg){
		$this->addOrderBy('ab.id', $arg);
	}

	public function FilterByLocation($arg){
		$this->addWhere('ab.location = "' . $arg . '"');
	}

	public function FilterByStatus($arg){
		$this->addWhere('ab.status = "' . $arg . '"');
	}
}
