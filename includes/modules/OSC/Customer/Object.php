<?php

namespace OSC\Customer;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
			
	protected
		$customersFirstname
		, $customersLastname
		, $customersEmailAddress
		, $customersAddress
		, $customersTelephone
		, $customersType
		, $customersLocation
		, $customersSocialNetwork
		, $customersAppId
		, $customersCompanyName
		, $customersContactName
		, $customersGender
		, $userName
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'user_name',
				'customers_firstname',
				'customers_lastname',
				'customers_email_address',
				'customers_address',
				'customers_telephone',
				'customers_location',
				'customers_gender',
			)
		);
	
		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				customers_firstname,
				user_name,
				customers_lastname,
				customers_email_address,
				customers_telephone,
				customers_address,
				customers_location,
				customers_gender
			FROM
				customers
			WHERE
				customers_id = '" . (int)$this->getId() . "'
		");
	
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: User not found",
				404
			);
		}
	
		$this->setProperties($this->dbFetchArray($q));
	}
	
	public function update() {
	
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
	
		$q = $this->dbQuery("
			UPDATE
				customers
			SET
				customers_firstname = '" . $this->dbEscape( $this->getCustomersFirstname() ) . "',
				customers_lastname = '" . $this->dbEscape( $this->getCustomersLastname() ) . "',
				customers_telephone = '" . $this->dbEscape( $this->getCustomersTelephone() ) . "',
				customers_location = '" . (int)$this->getCustomersLocation() . "',
				customers_address = '" . $this->dbEscape( $this->getCustomersAddress() ) . "'
			WHERE
				customers_id = '" . (int)$this->getId() . "'
		");
	
	}

	public function setUserName( $string ){
		$this->userName = (string)$string;
	}

	public function getUserName(){
		return $this->userName;
	}

	public function setCustomersFirstname( $string ){
		$this->customersFirstname = (string)$string;
	}
	
	public function getCustomersFirstname(){
		return $this->customersFirstname;
	}
	
	public function setcustomersLastName( $string ){
		$this->customersLastname = (string)$string;
	}
	
	public function getCustomersLastname(){
		return $this->customersLastname;
	}
	
	public function setCustomersEmailAddress( $string ){
		$this->customersEmailAddress = (string)$string;
	}
	
	public function getCustomersEmailAddress(){
		return $this->customersEmailAddress;
	}
	
	public function setCustomersAddress( $string ){
		$this->customersAddress = (string)$string;
	}
	
	public function getCustomersAddress(){
		return $this->customersAddress;
	}
	
	public function setCustomersTelephone( $string ){
		$this->customersTelephone = (string)$string;
	}
	
	public function getCustomersTelephone(){
		return $this->customersTelephone;
	}
	
	public function setCustomersAppId( $string ){
		$this->customersAppId = (string)$string;
	}
	
	public function getCustomersAppId(){
		return $this->customersAppId;
	}
	
	public function setCustomersCompanyName( $string ){
		$this->customersCompanyName = (string)$string;
	}
	
	public function getCustomersCompanyName(){
		return $this->customersCompanyName;
	}
	
	public function setCustomersContactName( $string ){
		$this->customersContactName = (string)$string;
	}
	
	public function getCustomersContactName(){
		return $this->customersContactName;
	}
	
	public function setCustomersGender( $string ){
		$this->customersGender = (string)$string;
	}
	
	public function getCustomersGender(){
		return $this->customersGender;
	}
	
	public function setCustomersLocation( $string ){
		$this->customersLocation = (int)$string;
	}
	
	public function getCustomersLocation(){
		return $this->customersLocation;
	}
	
	public function setCustomersSocialNetwork( $string ){
		$this->customersSocialNetwork = $string;
	}
	
	public function getCustomersSocialNetwork(){
		return $this->customersSocialNetwork;
	}
	
	public function setCustomersType( $string ){
		$this->customersType = $string;
	}
	
	public function getCustomersType(){
		return $this->customersType;
	}
	
}
