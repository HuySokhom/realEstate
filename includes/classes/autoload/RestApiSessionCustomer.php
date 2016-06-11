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
		// check email existing
		$check_email_query = tep_db_query("
			SELECT
				count(*) as total
			FROM
				" . TABLE_CUSTOMERS . "
			WHERE
				customers_email_address = '" . tep_db_input($params['PUT']['customers_email_address']) . "'
					and
				customers_id != '" . (int)$customerId . "'"
		);
		$check_email = tep_db_fetch_array($check_email_query);

		if ($check_email['total'] > 0) {
			$result =  false;
			echo $result;
		}else {
			if (!$customerId) {
				throw new \Exception(
					"403: Access Denied",
					403
				);
			} else {
				$cols->filterById($customerId);
				if ($cols->getTotalCount() > 0) {
					$cols->populate();
					$col = $cols->getFirstElement();
					$col->setId($customerId);
					$col->setProperties($params['PUT']);
					$col->update();
					$result = true;
					echo $result;
				}
			}
		}
	}
	
}
