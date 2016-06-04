<?php

use
	OSC\News\Collection as NewsCol,
	OSC\News\Object as NewsObj,
	OSC\NewsDescription\Object as NewsDescriptionObj
	;

class RestApiNews extends RestApi {

	public function get($params){
		$col = new NewsCol();
		$col->sortByDate('DESC');
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

	public function post($params){
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

	public function put($params){
		$cols = new NewsCol();
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

	public function delete(){

		$cols = new NewsCol();
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
