<?php

namespace OSC\ProductContactPerson;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$productsId
		, $customersId
		, $contactName
		, $contactPhone
		, $contactAddress
		, $contactLocation
		, $contactEmail
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'contact_name',
				'contact_phone',
				'contact_address',
				'contact_location',
				'contact_email',
			)
		);
		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				contact_name,
				contact_phone,
				contact_address,
				contact_location,
				contact_email
			FROM
				product_contact_person
			WHERE
				id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Product Contact Person not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

	}
	
	public function update() {
		if( !$this->getProductsId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				product_contact_person
			SET 
				contact_name = '" . $this->dbEscape( $this->getContactName() ) . "',
				contact_phone = '" . $this->dbEscape( $this->getContactPhone() ) . "',
				contact_email = '" . $this->dbEscape( $this->getContactEmail() ) . "',
				contact_location = '" . (int)$this->getContactLocation() . "',
				contact_address = '" . $this->dbEscape( $this->getContactAddress() ) . "'
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
	}

	public function delete(){
		if( !$this->getProductsId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				product_contact_person
			WHERE
				id = '" . (int)$this->getProductsId() . "'
		");
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				product_contact_person
			(
				customers_id,
				products_id,
				contact_name,
				contact_phone,
				contact_email,
				contact_location,
				contact_address
			)
				VALUES
			(
 				'" . $this->getCustomersId() . "',
 				'" . $this->getProductsId() . "',
 				'" . $this->dbEscape( $this->getContactName() ) . "',
 				'" . $this->getContactPhone() . "',
 				'" . $this->dbEscape( $this->getContactEmail() ) . "',
				'" . $this->getContactLocation() . "',
				'" . $this->dbEscape( $this->getContactAddress() ) . "'
			)
		");
	}
	
	public function setContactAddress( $string ){
		$this->contactAddress = $string;
	}
	
	public function getContactAddress(){
		return $this->contactAddress;
	}
	
	public function setContactEmail( $string ){
		$this->contactEmail = $string;
	}
	
	public function getContactEmail(){
		return $this->contactEmail;
	}

	public function setContactLocation( $int ){
		$this->contactLocation = (int)$int;
	}

	public function getContactLocation(){
		return $this->contactLocation;
	}

	public function setContactPhone( $int ){
		$this->contactPhone = $int;
	}

	public function getContactPhone(){
		return $this->contactPhone;
	}

	public function setContactName( $string ){
		$this->contactName = $string;
	}

	public function getContactName(){
		return $this->contactName;
	}

	public function setCustomersId( $string ){
		$this->customersId = (int)$string;
	}
	
	public function getCustomersId(){
		return $this->customersId;
	}

	public function setProductsId( $string ){
		$this->productsId = (int)$string;
	}

	public function getProductsId(){
		return $this->productsId;
	}
}
