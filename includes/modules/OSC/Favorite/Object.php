<?php

namespace OSC\Favorite;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$productsId
		, $sessionId
	;


	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'products_id',
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				product_id,
				session_id
			FROM
				favorite
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Favorite not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

	}

	public function delete(){
		$this->dbQuery("
			DELETE FROM
				favorite
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
					AND
				session_id = '". $this->getSessionId() ."'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				favorite
			(
				products_id,
				session_id,
				create_date
			)
				VALUES
			(
				'" . $this->getProductsId() . "',
				'" . $this->getSessionId() . "',
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setSessionId( $string ){
		$this->sessionId = (string)$string;
	}

	public function getSessionId(){
		return $this->sessionId;
	}

	public function setProductsId( $string ){
		$this->productsId = (int)$string;
	}
	public function getProductsId(){
		return $this->productsId;
	}

}
