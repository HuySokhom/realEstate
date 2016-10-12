<?php

namespace OSC\PlanPrice;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('plan_price', 'plp');
		$this->idField = 'plp.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}
	
	public function filterById( $arg ){
		$this->addWhere("plp.id = '" . (int)$arg. "' ");
	}

}
