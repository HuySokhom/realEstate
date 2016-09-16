<?php

namespace OSC\ContentDescription;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$content
		, $pagesTitle
		, $pagesId
		, $languageId
	;

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'pages_id',
				'content',
				'pages_title',
				'language_id'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				pages_title,
				pages_id,
				content,
				language_id
			FROM
				pages_description
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
				pages_description
			SET
				pages_title = '" .  $this->getPagesTitle() . "',
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
				pages_description
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
				'" . $this->getPagesTitle() . "',
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

	public function setPagesTitle( $string ){
		$this->pagesTitle = (string)$string;
	}
	public function getPagesTitle(){
		return $this->pagesTitle;
	}

	public function setPagesId( $string ){
		$this->pagesId = (int)$string;
	}
	public function getPagesId(){
		return $this->pagesId;
	}

	public function setLanguageId( $string ){
		$this->languageId = (int)$string;
	}
	public function getLanguageId(){
		return $this->languageId;
	}
}
