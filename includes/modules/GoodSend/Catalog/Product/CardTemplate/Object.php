<?php

namespace GoodSend\Catalog\Product\CardTemplate;

use
	Aedea\Core\Database\StdObject as DbObj
	, GoodSend\Catalog\Product\CardTemplate\Field\Collection as FieldsCol
;

class Object extends DbObj {
		
	protected
		$name
		, $width
		, $height
		, $imageThumbnail
		, $imageBackground
		, $fields
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name',
				'width',
				'height',
				'image_thumbnail',
				'image_background',
				'fields',
				'status',
			)
		);

		return parent::toArray($args);
	}

	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->fields = new FieldsCol;
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				id,
				name,
				width,
				height,
				image_thumbnail,
				image_background,
				status,
				created,
				modified
			FROM
				templates
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: CardTemplate not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
		
		$this->fields->setFilter('template_id', $this->getId());
		// @todo: filter by status (passed as param?)
		$this->fields->populate();
	}
	
	public function updateStatus() {
		
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
		
		$q = $this->dbQuery("
			UPDATE
				templates
			SET 
				status = '" . (int)$this->getStatus() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
	}
	
	public function delete(){
		if( !$this->getId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				templates
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
				templates
			SET
				name = '" . $this->dbEscape( $this->getName() ) . "',
				width = '" . $this->dbEscape( (int)$this->getWidth() ) . "',
 				height = '" . $this->dbEscape( (int)$this->getHeight() ) . "',
 				image_thumbnail = '" . $this->dbEscape( $this->getImageThumbnail() ) . "',
				image_background = '" . $this->dbEscape( $this->getImageBackground() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				templates
			(
				name,
				width,
				height,
				image_thumbnail,
				image_background,
				status,
				created
			)
				VALUES
			(
				'" . $this->dbEscape( $this->getName() ) . "',
 				'" . $this->dbEscape( (int)$this->getWidth() ) . "',
				'" . $this->dbEscape( (int)$this->getHeight() ) . "',
 				'" . $this->dbEscape( $this->getImageThumbnail() ) . "',
 				'" . $this->dbEscape( $this->getImageBackground() ) . "',
				'" . $this->dbEscape( $this->getStatus() ) . "',
				NOW()
			)
		");	
		$this->setId( $this->dbInsertId() );
	}
	
	public function setName( $string ){
		$this->name = (string)$string;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setWidth( $int ){
		$this->width = (int)$int;	
	}
	
	public function getWidth(){
		return $this->width;
	}
	
	public function setHeight( $int ){
		$this->height = (int)$int;
	}
	
	public function getHeight(){
		return $this->height;
	}
	
	public function setImageThumbnail( $string ){
		$this->imageThumbnail = (string)$string;
	}
	
	public function getImageThumbnail(){
		return $this->imageThumbnail;
	}
		
	public function getFields(){
		return $this->fields;
	}

	public function setFields( $array ){
		$this->fields = $array;
	}
	
	public function setImageBackground( $string ){
		$this->imageBackground = (string)$string;
	}
	
	public function getImageBackground(){
		return $this->imageBackground;
	}

}
