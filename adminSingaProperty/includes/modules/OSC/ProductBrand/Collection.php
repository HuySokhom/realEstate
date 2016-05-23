<?php

namespace OSC\ProductBrand;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);

		$this->addTable('products_brand', 'pb');
		$this->idField = 'pb.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function sortByOrder($arg){
		$this->addOrderBy('i.sort_order', $arg);
	}
}
