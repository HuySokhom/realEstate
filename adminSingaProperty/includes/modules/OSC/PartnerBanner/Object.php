<?php

namespace OSC\PartnerBanner;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$title
		, $image
		, $imageThumbnail
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
				'image_thumbnail',
				'link',
				'sort_order',
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
				image_thumbnail,
				image,
				sort_order
			FROM
				banner_partner
			WHERE
				id = '" . (int)$this->getId() . "'	
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Banner Partner not found",
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
				banner_partner
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
				banner_partner
			SET
				title = '" . $this->dbEscape( $this->getTitle() ) . "',
				image = '" . $this->dbEscape( $this->getImage() ) . "',
				image_thumbnail = '" . $this->dbEscape( $this->getImageThumbnail() ) . "',
				link = '" . $this->dbEscape( $this->getLink() ) . "',
				sort_order = '" . $this->dbEscape( $this->getSortOrder() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
	}
	
	public function insert()
	{
		$this->dbQuery("
			INSERT INTO
				banner_partner
			(
				title,
				link,
				image,
				image_thumbnail,
				sort_order,
				status,
				create_date
			)
				VALUES
			(
				'" . $this->dbEscape($this->getTitle()) . "',
				'" . $this->dbEscape($this->getLink()) . "',
				'" . $this->dbEscape($this->getImage()) . "',
				'" . $this->dbEscape($this->getImageThumbnail()) . "',
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
	
	public function setImageThumbnail( $string ){
		$this->imageThumbnail = (string)$string;
	}

	public function getImageThumbnail(){
		return $this->imageThumbnail;
	}

}
