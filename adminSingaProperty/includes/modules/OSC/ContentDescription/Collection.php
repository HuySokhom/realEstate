<?php

namespace OSC\ContentDescription;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('pages_description', 'pd');
		$this->idField = 'pd.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("pd.id = '" . (int)$arg. "' ");
	}

	public function filterByPagesId( $arg ){
		$this->addWhere("pd.pages_id = '" . (int)$arg. "' ");
	}

	public function filterByTitle( $arg ){
		$this->addWhere("pd.pages_title LIKE '%" . $arg. "%' ");
	}


}
