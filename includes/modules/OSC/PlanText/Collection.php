<?php

namespace OSC\PlanText;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('plan_text', 'plt');
		$this->idField = 'plt.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}
	
	public function filterById( $arg ){
		$this->addWhere("plp.id = '" . (int)$arg. "' ");
	}

	public function sortByOrder( $arg ){
		$this->addOrderBy('plt.sort_order', $arg);
	}
}
