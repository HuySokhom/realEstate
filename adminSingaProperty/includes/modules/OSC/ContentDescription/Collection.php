<?php

namespace OSC\ContentDescription;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('content_description', 'ct');
		$this->idField = 'ct.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("ct.id = '" . (int)$arg. "' ");
	}

	public function filterByContentId( $arg ){
		$this->addWhere("ct.content_id = '" . (int)$arg. "' ");
	}

	public function filterByTitle( $arg ){
		$this->addWhere("ct.title LIKE '%" . $arg. "%' ");
	}


}
