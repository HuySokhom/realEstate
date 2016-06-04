<?php

namespace OSC\NewsDescription;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('news_description', 'nd');
		$this->idField = 'nd.id';
		$this->setDistinct(true);		
		$this->objectType = __NAMESPACE__ . '\Object';	
	}

	public function filterById( $arg ){
		$this->addWhere("nd.id = '" . (int)$arg. "' ");
	}

	public function filterByNewsId( $arg ){
		$this->addWhere("nd.news_id = '" . (int)$arg. "' ");
	}

}
