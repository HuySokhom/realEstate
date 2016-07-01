app.controller(
	'property_post_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'Upload'
	, '$timeout'
	, '$log'
	, function ($scope, Restful, Services, $location, Upload, $timeout, $log){
		$scope.service = new Services();
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
		$scope.optionalImage = [];
		$scope.propertyTypes = ["For Sale", "For Rent", "Both Sale and Rent"];
		// init category
		$scope.initCategory = function(){
			Restful.get("api/Category").success(function(data){
				$scope.categoryList = data;
			});
			Restful.get("api/Location").success(function(data){
				$scope.provinces = data;
			});
		};
		$scope.initCategory();
		$scope.disabled = true;
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
		// save functionality
		$scope.save = function(){
			// set object to save into news
			var data = {
				products: {
					products_image: $scope.image,
					products_image_thumbnail: $scope.image_thumbnail,
					map_lat: $scope.marker.coords.latitude,
					map_long: $scope.marker.coords.longitude,
					map_title: $scope.map_title,
					categories_id: $scope.categories_id,
					province_id: $scope.province_id,
					district_id: $scope.district_id,
					village_id: $scope.commune_id,
					products_price: $scope.price,
					products_kind_of: $scope.property_type,
					bed_rooms: $scope.bed_rooms,
					bath_rooms: $scope.bath_rooms,
					number_of_floors: $scope.number_of_floors,
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
			//console.log(data);
			Restful.post("api/Session/User/ProductPost", data).success(function (data) {
				$scope.disabled = true;
				//console.log(data);
				$scope.service.alertMessage('<b>Complete: </b>Save Success.');
				$location.path('manage_property');
			});
		};

		//functionality upload image
		$scope.uploadPic = function(file, type) {
			// validate on if image option limit with 8 photo.
			if(type == 'optional') {
				if($scope.optionalImage.length >= 8){
					return $scope.service.alertMessagePromt('<b>Warning: </b>We limit image upload only 8 photo.');
				}
			}
			if (file) {
				file.upload = Upload.upload({
					url: 'api/UploadImage',
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

		/*************************************
		 * start google map functionality  ***
		 * start google map functionality  ***
		 ************************************/

		$scope.map = {
			center: {
				latitude: 11.534289603605892,
				longitude: 104.88615066528314
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
				latitude: 11.534289603605892,
				longitude: 104.88615066528314
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
		/************************************************************************ /
		/******* to set every move marker set center map uncommand ***************/
		/******************************************************************* *****/
		//$scope.$watchCollection("marker.coords", function(newVal, oldVal) {
		//	$scope.map.center.latitude = $scope.marker.coords.latitude;
		//	$scope.map.center.longitude = $scope.marker.coords.longitude;
		//	if (_.isEqual(newVal, oldVal))
		//		return;
		//	$scope.coordsUpdates++;
		//});
		//$timeout(function() {
		//	$scope.marker.coords = {
		//		latitude: 11.75,
		//		longitude: 105.07
		//	};
		//	$scope.dynamicMoveCtr++;
		//	$timeout(function() {
		//		$scope.marker.coords = {
		//			latitude: 11.75,
		//			longitude: 105.07
		//		};
		//		$scope.dynamicMoveCtr++;
		//	}, 2000);
		//}, 1000);

	}
]);