<?php

use
	OSC\Product\Collection
		as ProductPostCol
	, OSC\Product\Object
		as ProductPostObj
	, OSC\ProductToCategory\Object
		as ProductToCategoryObj
	, OSC\ProductDescription\Object
		as ProductDescriptionObj
	, OSC\ProductContactPerson\Object
		as ProductContactPersonObj
	, OSC\ProductImage\Object
		as ProductImageObj
;

class RestApiSessionUserProductPost extends RestApi {

	public function get($params){
		$col = new ProductPostCol();
		$userId = $this->getOwner()->getId();
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$col->sortByDate('DESC');
			$col->filterByCustomersId($userId);
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
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$productObject = new ProductPostObj();
			$userId = $this->getOwner()->getId();
			$productObject->setCustomersId($userId);
			$productObject->setProperties($params['POST']['products']);
			$productObject->insert();
			$productId = $productObject->getProductsId();

			// save product to category
			$productToCategoryObject = new ProductToCategoryObj();
			$productToCategoryObject->setProductsId($productId);
			$productToCategoryObject->setCategoriesId($params['POST']['products']['categories_id']);
			$productToCategoryObject->insert();

//			$productContactPersonObject = new ProductContactPersonObj();
//			$productContactPersonObject->setProductsId($productId);
//			$productContactPersonObject->setCustomersId($userId);
//			$productContactPersonObject->setProperties($params['POST']['contact_person'][0]);
//			$productContactPersonObject->insert();

			// save product description
			$fields = $params['POST']['products_description'];
			$productDetailObject = new ProductDescriptionObj();
			foreach ( $fields as $k => $v){
				$productDetailObject->setProductsId($productId);
				$productDetailObject->setProperties($v);
				$productDetailObject->insert();
			}
			unset($params);
			return array(
				'data' => array(
					'id' => $productId
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

//				$fields = $params['PUT']['products_image'];
//				foreach ( $fields as $k => $v){
//					if( $v['image'] != '') {
//						$productImageObject = new ProductImageObj();
//						$productImageObject->setProperties($v);
//						$productImageObject->setProductsId($productId);
//						$productImageObject->update();
//					}
//				}

			}
		}
	}

	public function patch($params){
		$userId = $this->getOwner()->getId();
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$cols = new ProductPostCol();
			$cols->filterByCustomersId($userId);
			$cols->filterById( $this->getId() );
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setProductsId($this->getId());
				if( $params['PATCH']['name'] ){
					$col->setProductsStatus($params['PATCH']['status']);
					$col->updateStatus();
				}else{
					$col->refreshDate();
				}
			}
			return array(
				'data' => array(
					'data' => 'update success'
				)
			);
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
			$cols = new ProductPostCol();
			$cols->filterByCustomersId($userId);
			$cols->filterById( $this->getId() );
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setProductsId($this->getId());
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

