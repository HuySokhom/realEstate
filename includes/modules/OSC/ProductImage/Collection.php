<?php

namespace OSC\ProductImage;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('products_images', 'pi');
		$this->idField = 'pi.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterByProductsId( $arg ){
		$this->addWhere("pi.products_id = '" . (int)$arg. "' ");
	}
	
}
