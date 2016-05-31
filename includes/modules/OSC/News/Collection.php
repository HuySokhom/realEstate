<?php

namespace OSC\News;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('news', 'n');
		$this->idField = 'n.id';
		$this->setDistinct(true);		
		$this->objectType = __NAMESPACE__ . '\Object';	
	}

	public function filterByUserId( $arg ){
		$this->addWhere("n.customer_id = '" . (int)$arg. "' ");
	}

	public function sortByDate( $arg ){
		$this->addOrderBy('n.create_date', $arg);
	}

	public function filterById( $arg ){
		$this->addWhere("n.id = '" . (int)$arg. "' ");
	}

	public function filterByTitle( $arg ){
		$this->addTable('news_description', 'nd');

		$this->addWhere(" n.id = nd.news_id ");
		$this->addWhere("nd.title LIKE '%" . $arg. "%' ");
	}

}
