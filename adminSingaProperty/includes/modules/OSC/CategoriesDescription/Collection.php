<?php

namespace OSC\CategoriesDescription;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('categories_description', 'c');
		$this->idField = 'c.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function sortByOrder($arg){
		$this->addOrderBy('c.id', $arg);
	}

	public function filterByLanguageId( $arg ){
		$this->addWhere("c.language_id = '" . (int)$arg . "'");
	}

	public function filterByCategoriesId($arg){
		$this->addWhere("c.categories_id = '" . (int)$arg . "' ");
	}

}
