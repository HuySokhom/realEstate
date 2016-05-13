<?php

namespace GoodSend\Catalog\Product\CardTemplate;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('templates', 't');
		$this->idField = 't.id';
		$this->setDistinct(true);
		
		$this->objectType = 'GoodSend\Catalog\Product\CardTemplate\Object';		
	}
	
	public function filterByStatus( $arg ){
		$this->addWhere("t.status = '" . (int)$arg . "'");
	}
	
	public function filterByProductId( $arg ){
		$this->addTable('products_to_templates', 'p2t');
		
		$this->addWhere("p2t.products_id = '" . (int)$arg . "'");
		$this->addWhere("p2t.templates_id = t.id");
	}
}
