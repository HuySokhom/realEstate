<?php

namespace OSC\Vehicles\Seat;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('vehicle_seats', 'vs');
		$this->idField = 'vs.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}
	
}
