<?php

use
	OSC\Customer\Collection
		as CustomerCol
;

class RestApiSessionCustomer extends RestApi {

	public function get(){		
		$col = new CustomerCol();
		$customerId = $this->getOwner()->getId();
		if ( ! $customerId ) {
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else{			
			$col->filterById($customerId);
			$this->applySortBy($col, $params);
			return $this->getReturn($col, $params);			
		}
	}
	
	public function put($params){
		$cols = new CustomerCol();
		$customerId = $this->getOwner()->getId();
		if ( ! $customerId ) {
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else{
			$cols->filterById($customerId);
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setId($customerId);
				$col->setProperties($params['PUT']);				
				$col->update();
			}
		}
	}
	
}
