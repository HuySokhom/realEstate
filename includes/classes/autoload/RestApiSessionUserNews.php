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
		$userType = $_SESSION['user_type'];
		if( !$userId || $userType != "member"){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$col->sortByDate('DESC');
			$col->filterByUserId($userId);
			$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
			$params['GET']['type'] ? $col->filterByTypeId($params['GET']['type']) : '';
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
		$userType = $_SESSION['user_type'];
		// security of user
		if( !$userId || $userType != "member"){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$newsObj = new NewsObj();
			$userId = $this->getOwner()->getId();
			$newsObj->setCustomerId($userId);
			$newsObj->setCreateBy($_SESSION['user_name']);
			$newsObj->setProperties( $params['POST']['news'] );
			$newsObj->insert();
			$newId = $newsObj->getId();

			$newsDetailObj = new NewsDescriptionObj();
			$fields = $params['POST']['news_description'];
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
		$userType = $_SESSION['user_type'];
		if( !$userId || $userType != "member"){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}else {
			$cols = new NewsCol();
			$cols->filterByUserId($userId);
			$newsId = $this->getId();
			$cols->filterById( $newsId );
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				$col->setId($this->getId());
				$col->setProperties($params['PUT']['news']);
				$col->setUpdateBy($_SESSION['user_name']);
				$col->update();

				$fields = $params['PUT']['news_description'];
				$newsDetailObj = new NewsDescriptionObj();
				foreach ( $fields as $k => $v){
					$newsDetailObj->setNewsId($newsId);
					$newsDetailObj->setProperties($v);
					$newsDetailObj->update();
					unset($v);
				}
			}
			return array(
				'data' => array(
					'success' => 'true'
				)
			);
		}
	}

	public function delete(){
		$userId = $this->getOwner()->getId();
		$userType = $_SESSION['user_type'];
		if( !$userId || $userType != "member"){
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
