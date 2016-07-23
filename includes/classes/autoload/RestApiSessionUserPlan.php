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
			$count = tep_db_query("select count(id) as total, id from customers_plan where customers_id = '" . $userId . "'");
			$total = tep_db_fetch_array($count);
			if($total['total'] > 0){
				$plan = new planObj();
				$plan->setId($total['id']);
				$plan->setPlan($params['POST']['plan']);
				$plan->update();
				return array(
					'data' => array(
						'id' => 'success'
					)
				);
			}else {
				$plan = new planObj();
				$plan->setCustomersId($userId);
				$plan->setPlan($params['POST']['plan']);
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


}
