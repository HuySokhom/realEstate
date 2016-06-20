app.controller(
	'property_post_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'Upload'
	, '$timeout'
	, function ($scope, Restful, Services, $location, Upload, $timeout){
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
		$scope.propertyTypes = ["For Sale", "For Rent", "Both Sale and Rent"];
		// init category
		$scope.initNewsType = function(){
			Restful.get("api/Category").success(function(data){
				$scope.categoryList = data;
			});
			Restful.get("api/Location").success(function(data){
				$scope.provinces = data;
			});
		};
		$scope.initNewsType();

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
				]
			};
			$scope.disabled = false;
			console.log(data);
			Restful.post("api/Session/User/ProductPost", data).success(function (data) {
				$scope.disabled = true;
				console.log(data);
				$scope.service.alertMessage('<b>Complete: </b>Save Success.');
				//$location.path('manage_property');
			});
		};

		//functionality upload
		$scope.uploadPic = function(file) {
			if (file) {
				file.upload = Upload.upload({
					url: 'api/UploadImage',
					data: {file: file, username: $scope.username},
				});
				file.upload.then(function (response) {
					$timeout(function () {console.log(response);
						file.result = response.data;
						$scope.image = response.data.image;
						$scope.image_thumbnail = response.data.image_thumbnail;
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


		$scope.dropzoneConfig = {
			'options': { // passed into the Dropzone constructor
				'url': 'upload.php'
			},
			'eventHandlers': {
				'sending': function (file, xhr, formData) {
				},
				'success': function (file, response) {
				}
			}
		};
	}
]);

app.directive('dropZone', function() {
	return function(scope, element, attrs) {
		console.log(element);
		element.dropzone({
			url: "/upload",
			maxFilesize: 100,
			paramName: "uploadfile",
			maxThumbnailFilesize: 5,
			init: function() {
				scope.files.push({file: 'added'}); // here works
				this.on('success', function(file, json) {
				});

				this.on('addedfile', function(file) {
					scope.$apply(function(){
						alert(file);
						scope.files.push({file: 'added'});
					});
				});

				this.on('drop', function(file) {
					alert('file');
				});

			}

		});
	}
});
