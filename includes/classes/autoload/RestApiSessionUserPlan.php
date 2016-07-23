<?php

use
	OSC\CustomerPlan\Object as planObj
;

class RestApiSessionUserPlan extends RestApi {

	public function post($params){
		$userId = $this->getOwner()->getId();
		// security of user
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$plan = new planObj();
			$plan->setCustomersId($userId);
			$plan->setPlan( $params['POST']['plan'] );
			$plan->insert();
			$planId = $plan->getId();
			return array(
				'data' => array(
					'id' => $planId
				)
			);
		}
	}


}
