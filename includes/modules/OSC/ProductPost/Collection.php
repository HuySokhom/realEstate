<?php

namespace OSC\ProductPost;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('products', 'p');
		$this->idField = 'p.products_id';
		$this->setDistinct(true);		
		$this->objectType = __NAMESPACE__ . '\Object';	
	}
	
	public function filterByStatus( $arg ){
		$this->addWhere("p.products_status = '" . (int)$arg . "'");
	}

	public function filterByCustomersId( $arg ){
		$this->addWhere("p.customers_id = '" . (int)$arg. "' ");
	}

	public function filterById( $arg ){
		$this->addWhere("p.products_id = '" . (int)$arg. "' ");
	}

	public function sortByDate($arg){
		$this->addOrderBy('p.products_date_added', $arg);
	}
}
