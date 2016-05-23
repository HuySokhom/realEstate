<?php

namespace OSC\ImageSlider;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$text
		, $image
		, $link
		, $sortOrder
		, $imageThumbnail
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'text',
				'image',
				'link',
				'sort_order',
				'image_thumbnail'
			)
		);

		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				text,
				link,
				status,
				image,
				sort_order,
				image_thumbnail
			FROM
				image_slider
			WHERE
				id = '" . (int)$this->getId() . "'	
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Image not found",
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
				image_slider
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
				image_slider
			SET
				text = '" . $this->dbEscape( $this->getText() ) . "',
				image = '" . $this->dbEscape( $this->getImage() ) . "',
				image_thumbnail = '" . $this->dbEscape( $this->getImageThumbnail() ) . "',
				sort_order = '" . $this->dbEscape( $this->getSortOrder() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
	}
	
	public function insert()
	{
		$this->dbQuery("
			INSERT INTO
				image_slider
			(
				text,
				link,
				image,
				image_thumbnail,
				sort_order,
				created
			)
				VALUES
			(
				'" . $this->dbEscape($this->getText()) . "',
				'" . $this->dbEscape($this->getLink()) . "',
				'" . $this->dbEscape($this->getImage()) . "',
				'" . $this->dbEscape( $this->getImageThumbnail() ) . "',
				'" . (int)$this->getSortOrder() . "',
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

	public function setImageThumbnail( $string ){
		$this->imageThumbnail = (string)$string;
	}

	public function getImageThumbnail(){
		return $this->imageThumbnail;
	}

	public function setImage( $string ){
		$this->image = (string)$string;
	}

	public function getImage(){
		return $this->image;
	}

	public function setText( $string ){
		$this->text = (string)$string;
	}
	
	public function getText(){
		return $this->text;
	}
	
}
