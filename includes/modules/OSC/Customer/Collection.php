<?php

namespace OSC\Customer;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('customers', 'c');
		$this->idField = 'c.customers_id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ .'\Object';
	}
	
	public function filterById( $arg ){
		$this->addWhere("c.customers_id = '" . (int)$arg . "'");
	}
	
}
