<?php

namespace OSC\NewsType;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\NewsDescription\Collection as NewDescriptionCol
;

class Object extends DbObj {

	protected
		$nameEn,
		$nameKh
	;

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'name_en',
				'name_kh'
			)
		);
		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				name_en,
				name_kh,
				create_by,
				create_date
			FROM
				news_type
			WHERE
				id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: News Type not found",
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
				news_type
			SET 
				name_en = '" .  $this->getNameEn() . "',
				name_kh = '" .  $this->getNameKh() . "',
				update_by = '" .  $this->getUpdateBy() . "'
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
				news_type
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				news_type
			(
				name_en,
				name_kh,
				create_by,
				create_date
			)
				VALUES
			(
				'" . $this->getNameEn() . "',
				'" . $this->getNameKh() . "',
				'" . $this->getCreateBy() . "',
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setNameEn( $string ){
		$this->nameEn = $string;
	}

	public function getNameEn(){
		return $this->nameEn;
	}

	public function setNameKh( $string ){
		$this->nameKh = $string;
	}

	public function getNameKh(){
		return $this->nameKh;
	}

}
