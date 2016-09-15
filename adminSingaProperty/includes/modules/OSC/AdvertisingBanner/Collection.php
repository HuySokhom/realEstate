<?php

namespace OSC\AdvertisingBanner;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('advertising_banner', 'ab');
		$this->idField = 'ab.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function sortByOrder($arg){
		$this->addOrderBy('ab.sort_order', $arg);
	}

	
	public function filterById( $arg ){
		$this->addWhere("ab.id = '" . (int)$arg. "' ");
	}

}
