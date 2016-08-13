<?php

namespace OSC\Favorite;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('favorite', 'f');
		$this->idField = 'f.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("f.id = '" . (int)$arg. "' ");
	}

	public function filterByProductName( $arg ){
		$this->addWhere("f.product_name LIKE '%" . $arg. "%' ");
	}


	public function filterBySessionId( $arg ){
		$this->addWhere("f.session_id = '" . $arg. "' ");
	}

}
