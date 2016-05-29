<?php

namespace OSC\News;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\NewsDescription\Collection as NewDescriptionCol
;

class Object extends DbObj {

	protected
		$detail,
		$customerId
	;
	public function __construct( $params = array() ){
		parent::__construct($params);

		$this->detail = new NewDescriptionCol();
	}

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'customer_id',
				'status',
				'create_by',
				'create_date',
				'detail'
			)
		);
		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				customer_id,
				status,
				create_by,
				create_date
			FROM
				news
			WHERE
				id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: News not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

		$this->detail->setFilter('news_id', $this->getId());
		$this->detail->populate();
	}
	
	public function update() {
		if( !$this->getProductsId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				news
			SET 
				status = '" .  $this->getStatus() . "'
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
				news
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				news
			(
				customer_id,
				status
			)
				VALUES
			(
				'" . $this->getCustomerId() . "',
 				'" . $this->getStatus() . "'
			)
		");
	}

	public function setDetail( $array ){
		$this->detail = $array;
	}

	public function getDetail(){
		return $this->detail;
	}

	public function setCustomerId( $int ){
		$this->customerId = (int)$int;
	}

	public function getCustomerId(){
		return $this->customerId;
	}

}
