<?php

namespace OSC\CustomerPlan;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('customers_plan', 'cp');
		$this->idField = 'cp.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("cp.id = '" . (int)$arg. "' ");
	}

	public function filterByCustomerId( $arg ){
		$this->addWhere("cp.customers_id = '" . (int)$arg. "' ");
	}

	public function filterByStatus( $arg ){
		$this->addWhere("cp.status = '" . (int)$arg. "' ");
	}

	public function orderByDate( $arg ){
		$this->addOrderBy('cp.create_date', $arg);
	}


}
