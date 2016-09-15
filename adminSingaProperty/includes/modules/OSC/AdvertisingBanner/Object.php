<?php

namespace OSC\AdvertisingBanner;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$title
		, $image
		, $link
		, $sortOrder
		, $location
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'title',
				'image',
				'link',
				'sort_order',
				'location',
				'status'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				title,
				link,
				status,
				image,
				sort_order,
				location
			FROM
				advertising_banner
			WHERE
				id = '" . (int)$this->getId() . "'	
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Advertising not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
	}
	
	public function delete(){
		if( !$this->getId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				advertising_banner
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function update(){
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}		
		$this->dbQuery("
			UPDATE
				advertising_banner
			SET
				title = '" . $this->dbEscape( $this->getTitle() ) . "',
				image = '" . $this->dbEscape( $this->getImage() ) . "',
				link = '" . $this->dbEscape( $this->getLink() ) . "',
				location = '" . $this->dbEscape( $this->getLocation() ) . "',
				sort_order = '" . $this->dbEscape( $this->getSortOrder() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");		
	}
	
	public function updateStatus(){
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}		
		$this->dbQuery("
			UPDATE
				advertising_banner
			SET
				status = '" . $this->getStatus() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");		
	}

	public function insert()
	{
		$this->dbQuery("
			INSERT INTO
				advertising_banner
			(
				title,
				link,
				image,
				location,
				sort_order,
				status,
				create_date
			)
				VALUES
			(
				'" . $this->dbEscape($this->getTitle()) . "',
				'" . $this->dbEscape($this->getLink()) . "',
				'" . $this->dbEscape($this->getImage()) . "',
				'" . $this->dbEscape( $this->getLocation() ) . "',
				'" . (int)$this->getSortOrder() . "',
				1,
				NOW()
			)
		");
		$this->setId($this->dbInsertId());
	}

	public function setSortOrder( $string ){
		$this->sortOrder = (string)$string;
	}

	public function getSortOrder(){
		return $this->sortOrder;
	}

	public function setLink( $string ){
		$this->link = (string)$string;
	}

	public function getLink(){
		return $this->link;
	}

	public function setLocation( $string ){
		$this->location = (string)$string;
	}

	public function getLocation(){
		return $this->location;
	}

	public function setImage( $string ){
		$this->image = (string)$string;
	}

	public function getImage(){
		return $this->image;
	}

	public function setTitle( $string ){
		$this->title = (string)$string;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
}
