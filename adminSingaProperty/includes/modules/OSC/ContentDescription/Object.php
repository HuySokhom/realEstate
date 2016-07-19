<?php

namespace OSC\ContentDescription;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$content
		, $title
		, $languageId
	;

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'content',
				'title',
				'language_id'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				title,
				content,
				language_id
			FROM
				content_description
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Content description not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
	}

	public function update() {
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				content_description
			SET
				title = '" .  $this->getTitle() . "',
				content = '" . $this->dbEscape(  $this->getContent() ) . "',
				update_by = '" . $this->getUpdateBy() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
					AND
				language_id = '" . (int)$this->getLanguageId() . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				content_description
			(
				content,
				title,
				create_by,
				create_date,
				language_id
			)
				VALUES
			(
				'" . $this->dbEscape(  $this->getContent() ) . "',
				'" . $this->getTitle() . "',
				'" . $this->getCreateBy() ."',
				NOW(),
				'" . $this->getLanguageId() ."'
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setContent( $string ){
		$this->content = $string;
	}
	
	public function getContent(){
		return $this->content;
	}

	public function setTitle( $string ){
		$this->title = (string)$string;
	}
	public function getTitle(){
		return $this->title;
	}

	public function setLanguageId( $string ){
		$this->languageId = (int)$string;
	}
	public function getLanguageId(){
		return $this->languageId;
	}
}
