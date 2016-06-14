<?php

namespace OSC\ProductDescription;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('products_description', 'pd');
		$this->idField = 'pd.products_id';
		$this->setDistinct(true);		
		$this->objectType = __NAMESPACE__ . '\Object';	
	}

	public function filterById( $arg ){
		$this->addWhere("pd.products_id = '" . (int)$arg. "' ");
	}
}
