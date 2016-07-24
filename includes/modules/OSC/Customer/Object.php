<?php

namespace OSC\Customer;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
			
	protected
		$customersFirstname
		, $customersLastname
		, $customersFax
		, $customersEmailAddress
		, $customersAddress
		, $customersTelephone
		, $customersType
		, $customersLocation
		, $customersSocialNetwork
		, $customersAppId
		, $customersCompanyName
		, $customersContactName
		, $customersPlan
		, $planDate
		, $planExpire
		, $customersGender
		, $userName
		, $userType
		, $photo
		, $photoThumbnail
		, $detail
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'user_name',
				'user_type',
				'photo',
				'photo_thumbnail',
				'detail',
				'customers_email_address',
				'customers_address',
				'customers_fax',
				'customers_telephone',
				'customers_location',
				'customers_plan',
				'plan_date',
				'plan_expire',
			)
		);
	
		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				user_name,
				user_type,
				photo,
				customers_fax,
				photo_thumbnail,
				customers_email_address,
				customers_telephone,
				customers_address,
				customers_location,
				detail,
				customers_plan,
				plan_date,
				plan_expire
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

	public function updateUserType() {

		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}

		$this->dbQuery("
			UPDATE
				customers
			SET
				user_type = '" . $this->dbEscape( $this->getUserType() ) . "'
			WHERE
				customers_id = '" . (int)$this->getId() . "'
		");

	}


	public function update() {
	
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
	
		$this->dbQuery("
			UPDATE
				customers
			SET
				user_name = '" . $this->dbEscape( $this->getUserName() ) . "',
				customers_email_address = '" . $this->dbEscape( $this->getCustomersEmailAddress() ) . "',
				photo = '" . $this->dbEscape( $this->getPhoto() ) . "',
				photo_thumbnail = '" . $this->dbEscape( $this->getPhotoThumbnail() ) . "',
				customers_telephone = '" . $this->dbEscape( $this->getCustomersTelephone() ) . "',
				customers_fax = '" . $this->dbEscape( $this->getCustomersFax() ) . "',
				customers_location = '" . (int)$this->getCustomersLocation() . "',
				detail = '" . $this->dbEscape( $this->getDetail() ). "',
				customers_address = '" . $this->dbEscape( $this->getCustomersAddress() ) . "'
			WHERE
				customers_id = '" . (int)$this->getId() . "'
		");
	
	}

	public function setCustomersFax( $string ){
		$this->customersFax = (string)$string;
	}

	public function getCustomersFax(){
		return $this->customersFax;
	}

	public function setCustomersPlan( $string ){
		$this->customersPlan = (int)$string;
	}

	public function getCustomersPlan(){
		return $this->customersPlan;
	}

	public function setPlanDate( $string ){
		$this->planDate = (string)$string;
	}

	public function getPlanDate(){
		return $this->planDate;
	}

	public function setPlanExpire( $string ){
		$this->planExpire = (string)$string;
	}

	public function getPlanExpire(){
		return $this->planExpire;
	}

	public function setDetail( $string ){
		$this->detail = (string)$string;
	}

	public function getDetail(){
		return $this->detail;
	}

	public function setUserType( $string ){
		$this->userType = (string)$string;
	}

	public function getUserType(){
		return $this->userType;
	}

	public function setPhoto( $string ){
		$this->photo = (string)$string;
	}

	public function getPhoto(){
		return $this->photo;
	}

	public function setPhotoThumbnail( $string ){
		$this->photoThumbnail = (string)$string;
	}

	public function getPhotoThumbnail(){
		return $this->photoThumbnail;
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
