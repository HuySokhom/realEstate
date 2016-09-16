<?php

namespace OSC\Content;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\ContentDescription\Collection as ContentCol
;

class Object extends DbObj {

	protected
		$detail,
		$title
	;

	public function __construct( $params = array() ){
		parent::__construct($params);
		$this->detail = new ContentCol();
	}


	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'title',
				'status',
				'detail'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				status,
				title
			FROM
				pages
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Page not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

		$this->detail->setFilter('pages_id', $this->getId());
		$this->detail->populate();
	}

	public function setDetail( $string ){
		$this->detail = (string)$string;
	}
	public function getDetail(){
		return $this->detail;
	}

	public function setTitle( $string ){
		$this->title = (string)$string;
	}
	public function getTitle(){
		return $this->title;
	}
}
