app.controller(
	'product_edit_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, 'Services'
	, '$location'
	, 'alertify'
	, 'Upload'
	, '$timeout'
	, function ($scope, Restful, $stateParams, Services, $location, $alertify, Upload, $timeout){
		// init tiny option
		$scope.tinymceOptions = {
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern media"
			],
			toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			paste_data_images: true
		};
		$scope.propertyTypes = ["For Sale", "For Rent", "Both Sale and Rent"];
		$scope.sortType = [
			{
				id: 0,
				name: 'Free Plan'
			},
			{
				id: 1,
				name: 'Basic Plan'
			},
			{
				id: 2,
				name: 'Premium Plan'
			},
			{
				id: 3,
				name: 'Pro Plan'
			},
		];
		// init category
		$scope.initCategory = function(){
			Restful.get("api/Category").success(function(data){
				$scope.categoryList = data;
			});
			Restful.get("api/Location").success(function(data){
				$scope.provinces = data;
			});
			Restful.get("api/District/").success(function(data){
				$scope.districts = data;console.log(data);
			});
			Restful.get("api/Village/").success(function(data){
				$scope.communes = data;console.log(data);
			});
		};
		$scope.initCategory();

		// functional for init district
		$scope.initDistrict = function(id){
			Restful.get("api/District/" + id).success(function(data){
				$scope.districts = data;
				$scope.communes = '';
			});
		};
		// functional for init Commune
		$scope.initCommune = function(id){
			Restful.get("api/Village/" + id).success(function(data){
				$scope.communes = data;
			});
		};
		var url = 'api/Product/';
		$scope.service = new Services();

		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				$scope.optionalImage = data.elements[0].image_detail;
				$scope.district_id = data.elements[0].district_id;
				$scope.province_id = data.elements[0].province_id;
				$scope.property_type = data.elements[0].products_kind_of;
				$scope.bed_rooms = data.elements[0].bed_rooms;
				$scope.bath_rooms = data.elements[0].bath_rooms;
				$scope.number_of_floors = data.elements[0].number_of_floors;
				$scope.image_thumbnail = data.elements[0].products_image_thumbnail;
				$scope.image = data.elements[0].products_image;
				$scope.price = data.elements[0].products_price;
				$scope.categories_id = data.elements[0].categories_id;
				$scope.commune_id = data.elements[0].village_id;
				$scope.title_en = data.elements[0].product_detail[0].products_name;
				$scope.title_kh = data.elements[0].product_detail[1].products_name;
				$scope.content_en = data.elements[0].product_detail[0].products_description;
				$scope.content_kh = data.elements[0].product_detail[1].products_description;
				$scope.property_plan = data.elements[0].products_promote;
				$scope.longitude = data.elements[0].map_long;
				$scope.latitude = data.elements[0].map_lat;

				/********* Start init UI Google Map NG *************/
				$scope.map = {
					center: {
						latitude: $scope.latitude,
						longitude: $scope.longitude
					},
					zoom: 10
				};
				$scope.options = {
					scrollwheel: true
				};
				$scope.coordsUpdates = 0;
				$scope.dynamicMoveCtr = 0;

				$scope.marker = {
					id: 0,
					coords: {
						latitude: $scope.latitude,
						longitude: $scope.longitude
					},
					options: {
						draggable: true
					},
					events: {
						dragend: function(marker, eventName, args) {
							var lat = marker.getPosition().lat();
							var lon = marker.getPosition().lng();
							//$log.log(lat);
							//$log.log(lon);

							$scope.marker.options = {
								draggable: true,
								labelContent: "",
								labelAnchor: "100 0",
								labelClass: "marker-labels"
							};
						}
					}
				};

				/********* End init UI Google Map NG *************/
			});
		};
		$scope.init();
		$scope.longitude = 104;
		$scope.latitude = 11;
		/*************************************
		 * start google map functionality  ***
		 * start google map functionality  ***
		 ************************************/

		$scope.map = {
			center: {
				latitude: $scope.latitude,
				longitude: $scope.longitude
			},
			zoom: 10
		};
		$scope.options = {
			scrollwheel: true
		};
		$scope.coordsUpdates = 0;
		$scope.dynamicMoveCtr = 0;

		$scope.marker = {
			id: 0,
			coords: {
				latitude: $scope.latitude,
				longitude: $scope.longitude
			},
			options: {
				draggable: true
			},
			events: {
				dragend: function(marker, eventName, args) {
					var lat = marker.getPosition().lat();
					var lon = marker.getPosition().lng();
					//$log.log(lat);
					//$log.log(lon);

					$scope.marker.options = {
						draggable: true,
						labelContent: "",
						labelAnchor: "100 0",
						labelClass: "marker-labels"
					};
				}
			}
		};
		/************* End of Functionality google map NG ************************/
		// update functionality
		$scope.save = function(){
			// set object to save into news
			var data = {
				products: {
					products_image: $scope.image,
					products_image_thumbnail: $scope.image_thumbnail,
					categories_id: $scope.categories_id,
					province_id: $scope.province_id,
					district_id: $scope.district_id,
					village_id: $scope.commune_id,
					products_price: $scope.price,
					products_kind_of: $scope.property_type,
					bed_rooms: $scope.bed_rooms,
					bath_rooms: $scope.bath_rooms,
					number_of_floors: $scope.number_of_floors,
					products_promote: $scope.property_plan,
					map_lat: $scope.marker.coords.latitude,
					map_long: $scope.marker.coords.longitude,
				},
				products_description: [
					{
						products_name: $scope.title_en,
						products_description: $scope.content_en,
						language_id: 1
					},
					{
						products_name: $scope.title_kh,
						products_description: $scope.content_kh,
						language_id: 2
					}
				],
				products_image: $scope.optionalImage
			};
			$scope.disabled = false;

			Restful.put(url + $stateParams.id, data).success(function (data) {
				$scope.disabled = true;
				console.log(data);
				$scope.service.alertMessage('<b>Complete: </b>Update Success.');
				$location.path('product');
			});
		};

		//functionality upload
		$scope.uploadPic = function(file, type) {
			// validate on if image option limit with 8 photo.
			if(type == 'optional') {
				if($scope.optionalImage.length >= 8){
					return $scope.service.alertMessagePromt('<b>Warning: </b>We limit image upload only 8 photo.');
				}
			}
			if (file) {
				file.upload = Upload.upload({
					url: 'api/ImageUpload',
					data: {file: file, username: $scope.username},
				});
				file.upload.then(function (response) {
					$timeout(function () {
						file.result = response.data;
						if(type == 'feature_image') {
							$scope.image = response.data.image;
							$scope.image_thumbnail = response.data.image_thumbnail;
						}
						if(type == 'optional') {
							var option = {
								image: response.data.image,
								image_thumbnail: response.data.image_thumbnail
							};
							$scope.optionalImage.push(option);
						}
					});
				}, function (response) {
					if (response.status > 0)
						$scope.errorMsg = response.status + ': ' + response.data;
				}, function (evt) {
					// Math.min is to fix I	E which reports 200% sometimes
					file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
				});
			}
		};

		// remove image
		$scope.removeImage = function ($index) {
			$scope.optionalImage.splice($index, 1);
		};
	}
]);