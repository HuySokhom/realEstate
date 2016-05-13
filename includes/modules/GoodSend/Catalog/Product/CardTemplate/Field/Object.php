<?php

namespace GoodSend\Catalog\Product\CardTemplate\Field;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$templatesId
		, $name
		, $width
		, $height
		, $posX
		, $posY
		, $type
		, $text
		, $image
		, $fontSize
		, $fontFamily
		, $fontColor
		, $textAlignment
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name',
				'width',
				'height',
				'pos_x',
				'pos_y',	
				'type',
				'text',
				'image',
				'font_size',
				'font_family',
				'font_color',
				'text_alignment',
			)
		);
		
		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				id,
				templates_id,
				name,
				width,
				height,
				pos_x,
				pos_y,
				type,
				text,
				image,
				font_family,
				font_size,
				font_color,
				text_alignment,
				status,
				created,
				modified
			FROM
				templates_fields
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: CardTemplateField not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
	}
	
	public function update(){
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				templates_fields
			SET
				width = '" . $this->dbEscape( (int)$this->getWidth() ) . "',
 				height = '" . $this->dbEscape( (int)$this->getHeight() ) . "',
 				pos_x = '" . $this->dbEscape( (int)$this->getPosX() ) . "',
				pos_y = '" . $this->dbEscape( (int)$this->getPosY() ) . "',
				text = '" . $this->dbEscape( $this->getText() ). "',
				image = '" . $this->dbEscape( $this->getImage() ) . "',
				font_family = '" . $this->dbEscape( $this->getFontFamily() ) . "',
				font_color = '" . $this->dbEscape( $this->getFontColor() ) . "',
				font_size = '" . $this->dbEscape( $this->getFontSize() ). "',
				text_alignment = '" . $this->dbEscape( $this->getTextAlignment() ) . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}
	
	public function insert(){
		$this->dbQuery("
			INSERT INTO
				templates_fields
			(
				templates_id,
				name,
				width,
				height,
				pos_x,
				pos_y,
				type,
				text,
				image,
				font_family,
				font_color,
				font_size,
				text_alignment,
				status,
				created
			)
				VALUES
			(
				'" . $this->dbEscape( (int)$this->getTemplatesId() ) . "',
				'" . $this->dbEscape( $this->getName() ) . "',
 				'" . $this->dbEscape( (int)$this->getWidth() ) . "',
				'" . $this->dbEscape( (int)$this->getHeight() ) . "',
 				'" . $this->dbEscape( (int)$this->getPosX() ) . "',
 				'" . $this->dbEscape( (int)$this->getPosY() ) . "',
				'" . $this->dbEscape( $this->getType() ) . "',
				'" . $this->dbEscape( $this->getText() ) . "',
				'" . $this->dbEscape( $this->getImage() ) . "',
				'" . $this->dbEscape( $this->getFontFamily() ) . "',
				'" . $this->dbEscape( $this->getFontColor() ) . "',
				'" . $this->dbEscape( (int)$this->getFontSize() ) . "',
				'" . $this->dbEscape( $this->getTextAlignment() ) . "',
				'" . $this->dbEscape( (int)$this->getStatus() ) . "',
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	/**
	 * Remove all field that relate with master field template id
	*/
	public function delete(){
		if( !$this->getTemplatesId() ) {
			throw new Exception("delete method requires template id");
		}
		$this->dbQuery("
			DELETE FROM
				templates_fields
			WHERE
				templates_id = '" . (int)$this->getTemplatesId() . "'
		");
	}

	/**
	 * remove single field field id
	 */
	public function deleteFeild(){
		if( !$this->getId() ) {
			throw new Exception("delete method requires id");
		}
		$this->dbQuery("
			DELETE FROM
				templates_fields
			WHERE
				id = '" . (int)$this->getId() . "'
		");
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
	
	public function setPosX( $int ){
		$this->posX = (int)$int;
	}
	
	public function getPosX(){
		return $this->posX;
	}
	
	public function setPosY( $int ){
		$this->posY = (int)$int;
	}
	
	public function getPosY(){
		return $this->posY;
	}
	
	public function setImage( $string ){
		$this->image = (string)$string;
	}
	
	public function getImage(){
		return $this->image;
	}
	
	public function setTemplatesId( $int ){
		$this->templatesId = (int)$int;
	}
	
	public function getTemplatesId(){
		return $this->templatesId;
	}
	
	public function setText( $string ){
		$this->text = (string)$string;
	}
	
	public function getText(){
		return $this->text;
	}
	
	public function setType( $string ){
		$this->type = (string)$string;
	}
	
	public function getType(){
		return $this->type;
	}

	public function setFontFamily( $string ){
		$this->fontFamily = (string)$string;
	}
	
	public function getFontFamily(){
		return $this->fontFamily;
	}
	public function setFontSize( $int ){
		$this->fontSize = (int)$int;
	}
	
	public function getFontSize(){
		return $this->fontSize;
	}
	public function setFontColor( $string ){
		$this->fontColor = (string)$string;
	}
	
	public function getFontColor(){
		return $this->fontColor;
	}
	public function setTextAlignment( $string ){
		$this->textAlignment = (string)$string;
	}
	
	public function getTextAlignment(){
		return $this->textAlignment;
	}

}
