<?php

use
	OSC\Customer\Collection
		as CustomersCol,
	OSC\Customer\Object
		as CustomersObject
;

class RestApiCustomer extends RestApi {

	public function get($params){
		$col = new CustomersCol();
		$col->sortByDate('DESC');
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
		$params['GET']['type'] ? $col->filterByType($params['GET']['type']) : '';

		if($params['GET']['plan'] != ''){
			$col->filterByPlan($params['GET']['plan']);
		}
		$params['GET']['search_name'] ? $col->filterByName($params['GET']['search_name']) : '';
		// start limit page
		$showDataPerPage = 10;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);
		return $this->getReturn($col, $params);

	}
	
	public function put($params){
		$cols = new CustomersCol();
		$customerId = $this->getId();
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
			$cols->filterById($customerId);
			if ($cols->getTotalCount() > 0) {
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setId($customerId);
				$col->setUpdateBy($_SESSION['username']);
				$col->setProperties($params['PUT']);
				$col->update();
				$result = true;
				echo $result;
			}
		}
	}

	public function patch($params){
		$obj = new CustomersObject();
		$obj->setId($this->getId());
		$obj->setUpdateBy($_SESSION['admin']['username']);
		$obj->setIsAgency($params['PATCH']['is_agency']);
		$obj->updateStatusAgency();
	}

	public function delete(){

		$obj = new CustomersObject();
		$obj->setId($this->getId());
		$obj->delete();
		return array(
			'data' => array(
				'data' => 'success'
			)
		);

	}
	
}
