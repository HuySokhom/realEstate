<?php

namespace OSC\ProductToCategory;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('products_to_categories', 'p');
		$this->idField = 'p.products_id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("p.products_id = '" . (int)$arg. "' ");
	}
	
}
