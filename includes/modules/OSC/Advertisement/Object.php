<?php

namespace OSC\Advertisement;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$title
		, $link
		, $sortOrder
		, $location
 		, $image
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'link',
				'title',
				'sort_order',
				'location',
				'image'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				title,
				image,
				link,
				sort_order,
				location
			FROM
				advertising_banner
			WHERE
				id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Advertisement not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
	}

	public function setTitle( $string ){
		$this->title = $string;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setLink( $string ){
		$this->link = $string;
	}
	
	public function getLink(){
		return $this->link;
	}

	public function setSortOrder( $string ){
		$this->sortOrder = (int)$string;
	}

	public function getSortOrder(){
		return $this->sortOrder;
	}

	public function setImage( $string ){
		$this->image = $string;
	}

	public function getImage(){
		return $this->image;
	}

	public function setLocation( $string ){
		$this->location = $string;
	}

	public function getLocation(){
		return $this->location;
	}

}
