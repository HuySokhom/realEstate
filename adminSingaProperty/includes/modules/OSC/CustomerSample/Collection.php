<?php

namespace OSC\CustomerSample;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('customers', 'c');
		$this->idField = 'c.customers_id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ .'\Object';
	}


	public function filterByStatus( $arg ){
		$this->addWhere("c.status = '" . (int)$arg . "'");
	}

	public function filterById( $arg ){
		$this->addWhere("c.customers_id = '" . (int)$arg . "'");
	}

	public function filterByName( $arg ){
		$this->addWhere("c.user_name LIKE '%" . $arg. "%' ");
	}

	public function sortByDate( $arg ){
		$this->addOrderBy('c.create_date', $arg);
	}

	public function filterByType( $arg ){
		$this->addWhere("c.user_type = '" . $arg . "'");
	}

}
