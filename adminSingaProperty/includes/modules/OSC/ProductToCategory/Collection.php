<?php

namespace OSC\ProductToCategory;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('products_to_categories', 'pc');
		$this->idField = 'pc.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}


	public function filterByCategoriesId( $arg ){
		$this->addWhere("pc.categories_id = '" . (int)$arg. "' ");
	}

	public function filterById( $arg ){
		$this->addWhere("pc.products_id = '" . (int)$arg. "' ");
	}
	
}
