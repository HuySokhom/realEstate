<?php

use
	OSC\News\Collection as NewsCol,
	OSC\News\Object as NewsObj,
	OSC\NewsDescription\Object as NewsDescriptionObj
;

class RestApiSessionUserNews extends RestApi {

	public function get($params){
		$col = new NewsCol();
		// security of user
		$userId = $this->getOwner()->getId();
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$col->sortByDate('DESC');
			$col->filterByUserId($userId);
			$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
			$params['GET']['search_title'] ? $col->filterByTitle($params['GET']['search_title']) : '';
			// start limit page
			$showDataPerPage = 10;
			$start = $params['GET']['start'];
			$this->applyLimit($col,
				array(
					'limit' => array( $start, $showDataPerPage )
				)
			);

			$this->applyFilters($col, $params);
			$this->applySortBy($col, $params);
			return $this->getReturn($col, $params);
		}
	}

	public function post($params){
		$userId = $this->getOwner()->getId();
		// security of user
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$newsObj = new NewsObj();
			$userId = $this->getOwner()->getId();
			$newsObj->setCustomerId($userId);
			$newsObj->insert();
			$newId = $newsObj->getId();

			$newsDetailObj = new NewsDescriptionObj();
			$fields = $params['POST']['news'];
			foreach ( $fields as $k => $v){
				$newsDetailObj->setNewsId($newId);
				$newsDetailObj->setProperties($v);
				$newsDetailObj->insert();
				unset($v);
			}

			return array(
				'data' => array(
					'id' => $newId
				)
			);
		}
	}

	public function put($params){
		$userId = $this->getOwner()->getId();
		if( !$userId ){
			throw new \Exception(
					"403: Access Denied",
					403
			);
		}else {var_dump($params['PUT']);
			$cols = new ProductPostCol();
			$cols->filterByCustomersId($userId);
			$productId = $this->getId();
			$cols->filterById( $productId );
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setProductsId($productId);
				$col->setProperties($params['PUT']['product'][0]);
				$col->update();

				$productDetailObject = new ProductDescriptionObj();
				$productDetailObject->setProductsId($productId);
				$productDetailObject->setProperties($params['PUT']['product_detail'][0]);
				$productDetailObject->update();
//
				$productToCategoryObject = new ProductToCategoryObj();
				$productToCategoryObject->setProductsId($productId);
				$productToCategoryObject->setProperties($params['PUT']['categories'][0]);
				$productToCategoryObject->update();
//
				$productContactPersonObject = new ProductContactPersonObj();
				$productContactPersonObject->setProductsId($productId);
				$productContactPersonObject->setProperties($params['PUT']['contact_person'][0]);
				$productContactPersonObject->update();

			}
		}
	}

	public function delete(){
		$userId = $this->getOwner()->getId();
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$cols = new NewsCol();
			$cols->filterByUserId($userId);
			$cols->filterById( $this->getId() );
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setId($this->getId());
				$col->delete();
			}
			return array(
				'data' => array(
					'data' => 'success'
				)
			);
		}
	}

}
