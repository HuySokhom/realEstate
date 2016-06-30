<?php

namespace OSC\Product;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\ProductDescription\Collection
		as ProductDescriptionCol
	, OSC\Customer\Collection
		as CustomerCol
	, OSC\CategoriesDescription\Collection
		as CategoryCollection
	, OSC\ProductImage\Collection
		as ProductImageCol
;

class Object extends DbObj {

	protected
		$customersId
		, $productsId
		, $provinceId
        , $districtId
        , $villageId
		, $productsImage
		, $productsImageThumbnail
		, $productsPrice
		, $productsDateAdded
		, $productsStatus
		, $productsKindOf
		, $bedRooms
		, $bathRooms
		, $numberOfFloors
		, $imageDetail
        , $productDetail
		, $categoriesId
		, $categoryDetail
		, $customersDetail
		, $productsPromote
		, $mapLat
		, $mapTitle
		, $mapLong
	;

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'categories_id',
				'products_promote',
				'map_long',
				'map_lat',
				'map_title',
				'category_detail',
				'customers_detail',
				'customers_id',
				'province_id',
                'district_id',
                'village_id',
				'products_image',
				'products_image_thumbnail',
				'products_price',
				'create_date',
				'create_by',
				'products_status',
				'products_kind_of',
				'bed_rooms',
				'bath_rooms',
                'number_of_floors',
				'image_detail',
				'product_detail'
			)
		);
		return parent::toArray($args);
	}

	public function __construct( $params = array() ){
 		parent::__construct($params);

 		$this->productDetail = new ProductDescriptionCol();
//		$this->customersDetail = new CustomerCol();
		$this->categoryDetail = new CategoryCollection();
		$this->imageDetail = new ProductImageCol();
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				customers_id,
				map_long,
				map_lat,
				map_title,
				products_promote,
				categories_id,
				province_id,
				district_id,
				village_id,
				products_image,
				products_image_thumbnail,
				products_price,
				products_date_added,
				products_status,
				products_kind_of,
				bed_rooms,
				bath_rooms,
				number_of_floors,
				create_date,
				create_by
			FROM
				products
			WHERE
				products_id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Products not found",
				404
			);
		}

		$this->setProperties($this->dbFetchArray($q));

//		$this->customersDetail->setFilter('id', $this->getCustomersId());
//		$this->customersDetail->populate();

 		$this->productDetail->setFilter('id', $this->getId());
 		$this->productDetail->populate();

		$this->categoryDetail->setFilter('categories_id', $this->getCategoriesId());
		$this->categoryDetail->populate();

		$this->imageDetail->setFilter('products_id', $this->getId());
		$this->imageDetail->populate();
	}

	public function updateStatus() {
		if( !$this->getProductsId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				products
			SET
				products_status = '" . (int)$this->getProductsStatus() . "'
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
				products
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");

		// remove products description
		$this->dbQuery("
			DELETE FROM
				products_description
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
		// remove products to categories
		$this->dbQuery("
			DELETE FROM
				products_to_categories
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
		// remove products contact
		$this->dbQuery("
			DELETE FROM
				product_contact_person
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
		// remove products image
		$this->dbQuery("
			DELETE FROM
				products_images
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
	}

	public function refreshDate(){
		$this->dbQuery("
			UPDATE
				products
			SET
				products_date_added = NOW()
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
	}
	public function update(){
		$this->dbQuery("
			UPDATE
				products
			SET
				province_id = '" . (int)$this->getProvinceId() . "',
				map_long = '" . $this->getMapLong() . "',
				map_lat = '" . $this->getMapLat() . "',
				map_title = '" . $this->getMapTitle() . "',
				categories_id = '" . (int)$this->getCategoriesId() . "',
				district_id = '" . (int)$this->getDistrictId() . "',
				village_id = '" . (int)$this->getVillageId() . "',
				products_image = '" . $this->getProductsImage() . "',
				products_image_thumbnail = '" . $this->getProductsImageThumbnail() . "',
 				products_price = '" . $this->getProductsPrice() . "',
 				products_kind_of = '" . $this->getProductsKindOf() . "',
 				number_of_floors = '" . $this->getNumberOfFloors() . "',
 				bed_rooms = '" . $this->getBedRooms() . "',
 				bath_rooms = '" . $this->getBathRooms() . "'
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");

	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				products
			(
				customers_id,
				map_long,
				map_lat,
				map_title,
				categories_id,
				province_id,
				district_id,
				village_id,
				products_image,
				products_image_thumbnail,
				products_promote,
				products_price,
				products_date_added,
				products_status,
				create_date,
				products_kind_of,
				bed_rooms,
				bath_rooms,
				number_of_floors
			)
				VALUES
			(
				'" . (int)$this->getCustomersId() . "',
				'" . $this->getMapLong() . "',
				'" . $this->getMapLat() . "',
				'" . $this->getMapTitle() . "',
				'" . (int)$this->getCategoriesId() . "',
				'" . (int)$this->getProvinceId() . "',
				'" . (int)$this->getDistrictId() . "',
				'" . (int)$this->getVillageId() . "',
 				'" . $this->dbEscape( $this->getProductsImage() ) . "',
 				'" . $this->dbEscape( $this->getProductsImageThumbnail() ) . "',
 				'" . (int)$this->getProductsPromote() . "',
				'" . $this->getProductsPrice() . "',
 				NOW(),
 				1,
 				NOW(),
				'" . $this->getProductsKindOf() . "',
				'" . (int)$this->getBedRooms() . "',
				'" . (int)$this->getBathRooms() . "',
				'" . (int)$this->getNumberOfFloors() . "'
			)
		");
		$this->setProductsId( $this->dbInsertId() );
	}

	public function setCustomersId( $int ){
		$this->customersId = (int)$int;
	}

	public function getCustomersId(){
		return $this->customersId;
	}

	public function setProvinceId( $int ){
		$this->provinceId = (int)$int;
	}

	public function getProvinceId(){
		return $this->provinceId;
	}

	public function setProductsId( $int ){
		$this->productsId = (int)$int;
	}

	public function getProductsId(){
		return $this->productsId;
	}

	public function setProductsDateAdded( $date ){
		$this->productsDateAdded = $date;
	}

	public function getProductsDateAdded(){
		return $this->productsDateAdded;
	}

	public function setProductsImageThumbnail( $string ){
		$this->productsImageThumbnail = (string)$string;
	}

	public function getProductsImageThumbnail(){
		return $this->productsImageThumbnail;
	}

	public function setProductsImage( $string ){
		$this->productsImage = (string)$string;
	}

	public function getProductsImage(){
		return $this->productsImage;
	}

	public function setProductsStatus( $int ){
		$this->productsStatus = (int)$int;
	}

	public function getProductsStatus(){
		return $this->productsStatus;
	}

	public function setDistrictId( $int ){
		$this->districtId = (int)$int;
	}

	public function getDistrictId(){
		return $this->districtId;
	}

	public function getVillageId(){
		return $this->villageId;
	}
	public function setVillageId( $int ){
		$this->villageId = (int)$int;
	}

	public function getProductsPromote(){
		return $this->productsPromote;
	}
	public function setProductsPromote( $int ){
		$this->productsPromote = (int)$int;
	}


	public function getProductsKindOf(){
		return $this->productsKindOf;
	}
	public function setProductsKindOf( $string ){
		$this->productsKindOf = $string;
	}

	public function getImageDetail(){
		return $this->imageDetail;
	}
	public function setImageDetail( $array ){
		$this->imageDetail = $array;
	}

	public function getProductDetail(){
		return $this->productDetail;
	}
	public function setProductDetail( $array ){
		$this->productDetail = $array;
	}

	public function getProductsPrice(){
		return $this->productsPrice;
	}
	public function setProductsPrice( $int ){
		$this->productsPrice = doubleval($int);
	}

    public function getBedRooms(){
        return $this->bedRooms;
    }
    public function setBedRooms( $int ){
        $this->bedRooms = (int)$int;
    }
    public function getBathRooms(){
        return $this->bathRooms;
    }
    public function setBathRooms( $int ){
        $this->bathRooms = (int)$int;
    }

	public function getCategoriesId(){
		return $this->categoriesId;
	}
	public function setCategoriesId( $int ){
		$this->categoriesId = (int)$int;
	}

    public function getNumberOfFloors(){
        return $this->numberOfFloors;
    }
    public function setNumberOfFloors( $int ){
        $this->numberOfFloors = (int)$int;
    }

	public function getCategoryDetail(){
		return $this->categoryDetail;
	}
	public function setCategoryDetail( $array ){
		$this->categoryDetail = $array;
	}

	public function getCustomersDetail(){
		return $this->customersDetail;
	}
	public function setCustomersDetail( $array ){
		$this->customersDetail = $array;
	}

	public function getMapLat(){
		return $this->mapLat;
	}
	public function setMapLat( $string ){
		$this->mapLat = $string;
	}

	public function getMapTitle(){
		return $this->mapTitle;
	}
	public function setMapTitle( $string ){
		$this->mapTitle = $string;
	}

	public function getMapLong(){
		return $this->mapLong;
	}
	public function setMapLong( $string ){
		$this->mapLong = $string;
	}
}
