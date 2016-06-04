<?php

namespace OSC\NewsDescription;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {

	protected
		$newsId,
		$languageId,
		$title,
		$content
	;
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'language_id',
				'title',
				'content'
			)
		);
		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				title,
				language_id,
				content
			FROM
				news_description
			WHERE
				id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: News Description not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

	}
	
	public function update() {
		if( !$this->getLanguageId() ) {
			throw new Exception("save method requires language id");
		}
		$this->dbQuery("
			UPDATE
				news_description
			SET 
				title = '" .  $this->getTitle() . "',
				content = '" .  $this->getContent() . "'
			WHERE
				language_id = '" . (int)$this->getLanguageId() . "'
					and
				news_id = '" . (int)$this->getNewsId() . "'
		");
	}

	public function delete(){
		if( !$this->getNewsId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				news_description
			WHERE
				news_id = '" . (int)$this->getNewsId() . "'
		");
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				news_description
			(
				news_id,
				title,
				content,
				language_id
			)
				VALUES
			(
				'" . $this->getNewsId() . "',
 				'" . $this->getTitle() . "',
 				'" . $this->getContent() . "',
 				'" . $this->getLanguageId() . "'
			)
		");
	}

	public function getLanguageId(){
		return $this->languageId;
	}
	public function setLanguageId($string){
		$this->languageId = (int)$string;
	}

	public function getTitle(){
		return $this->title;
	}
	public function setTitle($string){
		$this->title = $string;
	}

	public function getNewsId(){
		return $this->newsId;
	}
	public function setNewsId($string){
		$this->newsId = $string;
	}

	public function getContent(){
		return $this->content;
	}
	public function setContent($string){
		$this->content = $string;
	}

}
