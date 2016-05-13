<?php

namespace OSC\Vehicles\Model;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('vehicle_model', 'vm');
		$this->idField = 'vm.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}
	
}
