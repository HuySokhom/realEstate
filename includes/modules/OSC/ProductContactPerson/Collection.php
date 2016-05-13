<?php

namespace OSC\ProductContactPerson;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('product_contact_person', 'pcp');
		$this->idField = 'pcp.id';
		$this->setDistinct(true);		
		$this->objectType = __NAMESPACE__ . '\Object';	
	}

	public function filterByProductsId( $arg ){
		$this->addWhere("pcp.products_id = '" . (int)$arg. "' ");
	}
}
