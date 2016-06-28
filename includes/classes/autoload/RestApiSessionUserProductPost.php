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
			$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
			$params['GET']['type'] ? $col->filterByCategoryId($params['GET']['type']) : '';
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
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$productObject = new ProductPostObj();
			$userId = $this->getOwner()->getId();
			$productObject->setCustomersId($userId);
//			$productObject->setProductsPromote($_SESSION['customer_plan']);
			$productObject->setProperties($params['POST']['products']);
			$productObject->insert();
			$productId = $productObject->getProductsId();

			// save product to category
			$productToCategoryObject = new ProductToCategoryObj();
			$productToCategoryObject->setProductsId($productId);
			$productToCategoryObject->setCategoriesId($params['POST']['products']['categories_id']);
			$productToCategoryObject->insert();

			// save product images
			$productImageObject = new ProductImageObj();
			$fields = $params['POST']['products_image'];
			foreach ( $fields as $k => $v){
				$productImageObject->setProductsId($productId);
				$productImageObject->setProperties($v);
				$productImageObject->insert();
			}

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
		}else {
			$cols = new ProductPostCol();
			$cols->filterByCustomersId($userId);
			$productId = $this->getId();
			$cols->filterById( $productId );
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setProductsId($productId);
				$col->setProperties($params['PUT']['products']);
				$col->update();

				// update category to product
				$productToCategoryObject = new ProductToCategoryObj();
				$productToCategoryObject->setProductsId($productId);
				$productToCategoryObject->setCategoriesId($params['PUT']['products']['categories_id']);
				$productToCategoryObject->update();

				// save product description
				$fields = $params['PUT']['products_description'];
				$productDetailObject = new ProductDescriptionObj();
				foreach ( $fields as $k => $v){
					$productDetailObject->setProductsId($productId);
					$productDetailObject->setProperties($v);
					$productDetailObject->update();
					unset($v);
				}

				// update product image
				$imageFields = $params['PUT']['products_image'];
				$productImageObject = new ProductImageObj();
				$productImageObject->setProductsId($productId);
				// delete first insert new after
				$productImageObject->delete();
				foreach ( $imageFields as $k => $v){
					$productImageObject->setProductsId($productId);
					$productImageObject->setProperties($v);
					$productImageObject->insert();
					unset($v);
				}
				return array(
					'data' => array(
						'data' => 'update success'
					)
				);
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
	public function delete($params){
		$userId = $this->getOwner()->getId();
		if( !$userId ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {var_dump($params['DELETE']);
			if($params['DELETE']['image']){
				$image = new ProductImageObj();
				$image->setId($this->getId());
				$image->delete();
				return array(
					'data' => array(
						'data' => 'success'
					)
				);
			}else {
				$cols = new ProductPostCol();
				$cols->filterByCustomersId($userId);
				$cols->filterById($this->getId());
				if ($cols->getTotalCount() > 0) {
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

}

