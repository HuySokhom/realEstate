<?php

namespace GoodSend\Catalog\Product\CardTemplate\Field;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('templates_fields', 'f');
		$this->idField = 'f.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}
	
	public function filterByStatus( $arg ){
		$this->addWhere("f.status = '" . (int)$arg . "'");
	}
	
	public function filterByTemplateId( $arg ){
		$this->addWhere("f.templates_id = '" . (int)$arg . "'");
	}
}
