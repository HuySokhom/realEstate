<?php

namespace OSC\NewsType;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('news_type', 'nt');
		$this->idField = 'nt.id';
		$this->setDistinct(true);		
		$this->objectType = __NAMESPACE__ . '\Object';	
	}

	public function filterById( $arg ){
		$this->addWhere("nt.id = '" . (int)$arg. "' ");
	}

	public function filterByName( $arg ){
		$this->addWhere("nt.name LIKE '%" . $arg. "%' ");
	}

}
