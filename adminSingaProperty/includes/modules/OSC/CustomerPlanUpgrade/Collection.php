<?php

namespace OSC\CustomerPlanUpgrade;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('customers_plan_upgrade', 'cpu');
		$this->idField = 'cpu.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("cpu.id = '" . (int)$arg. "' ");
	}

	public function orderByDate($arg){
		$this->addOrderBy('cpu.create_date', $arg);
	}
}
