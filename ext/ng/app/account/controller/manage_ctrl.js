app.controller(
	'manage_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, 'Upload'
	, '$timeout'
	, function ($scope, Restful, Services, Upload, $timeout){
		var url = 'api/Session/User/ProductPost';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.products_post = data;
				$scope.totalItems = data.count;
			});
		};
		$scope.init();

		Restful.get('api/Manufacturers').success(function(data){
			$scope.manufacturers = data;
		});

		function initCustomer() {
			Restful.get('api/Session/Customer').success(function (data) {
				$scope.user = data.elements[0];
			});
		};
		initCustomer();

		$scope.closeForm = function(){
			clear();
			initCustomer();
		};

		Restful.get('api/Category').success(function(data){
			$('#category').html(data.html);
		});

		$scope.disabled = true;

		$scope.edit = function(params){console.log(params);
			tinymce.init({ selector:'#description',plugins: 'media' });
			tinymce.get('description').setContent(params.fields[0].products_description);
			$scope.id = params.id;
			// category
			$("div#category select").val(params.category[0].categories_id);
			//$( "#entryCategories option:selected" ).val();
			// product detail
			$scope.title = params.fields[0].products_name;
			$scope.description = params.fields[0].products_description;

			// product
			$scope.products_location = params.location_id;
			$scope.manufacturer = params.manufacturers_id;
			$scope.image = params.products_image;
			$scope.image_thumbnail = params.products_image_thumbnail;
			$scope.price = params.products_price;

			// product image
			$scope.product_image_thumbnail = params.image;
			//	angular.isDefined( $scope.products.image[0].image_thumbnail )
			//		?
			//	$scope.products.image[0].image_thumbnail
			//		:
			//	"";

			// contact
			$scope.user.user_name = params.contact[0].contact_name;
			$scope.user.customers_telephone = params.contact[0].contact_phone;
			$scope.user.customers_address = params.contact[0].contact_address;
			$scope.user.customers_location = params.contact[0].contact_location;
			$scope.user.customers_email_address = params.contact[0].contact_email;
			$('#product-popup').modal('show');
		};

		$scope.refreshDate = function(params){
			Restful.patch('api/Session/User/ProductPost/'+params.id).success(function(data){
				$scope.init();
			});
		};

		$scope.updateStatus = function(params){
			params.products_status == 1 ? params.products_status = 0 : params.products_status = 1;
			var data = { status: params.products_status, name: "update_status"};
			Restful.patch('api/Session/User/ProductPost/'+params.id, data).success(function(data){});
		};

		$scope.link = function(id){
			window.open('product_info.php?products_id=' + id,'_blank');
		};

		$scope.add = function(){
			tinymce.init({
				selector:'#description',
				plugins: 'media'
			});
		};

		$scope.save = function(){
			var category_id = $( "#entryCategories option:selected" ).val();
			// set object to save into product
			var params ={
				product_detail: [{
					products_name: $scope.title,
					products_description: tinymce.get('description').getContent()
				}],
				categories: [{
					categories_id: category_id
				}],
				product: [{
					location_id: $scope.products_location,
					manufacturers_id: $scope.manufacturer,
					products_image:	$scope.image,
					products_image_thumbnail: $scope.image_thumbnail,
					products_price: $scope.price,
				}],
				contact_person: [{
					contact_name: $scope.user.user_name,
					contact_phone: $scope.user.customers_telephone,
					contact_address: $scope.user.customers_address,
					contact_location: $scope.user.customers_location,
					contact_email: $scope.user.customers_email_address
				}],
				products_image: [
					{
						image: $scope.image1,
						image_thumbnail: $scope.image_thumbnail1
					},
					{
						image: $scope.image2,
						image_thumbnail: $scope.image_thumbnail2
					},
					{
						image: $scope.image3,
						image_thumbnail: $scope.image_thumbnail3
					},
					{
						image: $scope.image4,
						image_thumbnail: $scope.image_thumbnail4
					},
					{
						image: $scope.image5,
						image_thumbnail: $scope.image_thumbnail5
					},
					{
						image: $scope.image6,
						image_thumbnail: $scope.image_thumbnail6
					},
					{
						image: $scope.image7,
						image_thumbnail: $scope.image_thumbnail7
					},
					{
						image: $scope.image8,
						image_thumbnail: $scope.image_thumbnail8
					}
				]
			};
			if(params.product_detail[0].products_description == ''){
				return alert('Please input product description.');
			}
			if(angular.isUndefined(params.product[0].products_image) ){
				return alert('Please file add photo main image.');
			}
			if(
				$scope.user.customers_telephone == '' ||
				$scope.user.customers_address == '' ||
				$scope.user.customers_location == ''
			){
				return alert('Please input all information in contact.');
			}

			$scope.disabled = false;
			if($scope.id) {
				$scope.disabled = true;
				Restful.put('api/Session/User/ProductPost/' + $scope.id, params).success(function (data) {
					$scope.init();
					$scope.closeForm();
					$.notify({
						title: '<strong>Success: </strong>',
						message: 'Update Success.'
					}, {
						type: 'success'
					});
					$('#product-popup').modal('hide');
				});
			}else {
				Restful.save('api/Session/User/ProductPost', params).success(function (data) {
					$scope.init();
					$scope.closeForm();
					$scope.disabled = true;
					$('#product-popup').modal('hide');
					$.notify({
						title: '<strong>Success: </strong>',
						message: 'Save Success.'
					}, {
						type: 'success'
					});
				});
			}
		};

		$scope.remove = function(id, $index){
				if (confirm('Are you sure you want to delete this product?')) {
				Restful.delete( 'api/Session/User/ProductPost/' + id ).success(function(data){
					$.notify({
						title: '<strong>Success: </strong>',
						message: 'Delete Success.'
					},{
						type: 'success'
					});
					$scope.init();
					//$scope.products_post.elements.splice($index, 1);
				});

			}
		};

		// functionality check if in array of image
		var checkImageType = function isInArray(value, array) {
			return array.indexOf(value) > -1;
		};
		//functionality upload
		$scope.uploadPic = function(file, type) {
			if (file) {
				// check image type
				// if need more add in imageType
				var imageType = ['image/jpeg','image/png'];
				if ( checkImageType(file.type, imageType) ) {
					/* validate if image size is bigger than 10MB */
					var imageSize = (file.size / 1024) / 1024;
					if (imageSize < 5) {
						file.upload = Upload.upload({
							url: 'api/UploadImage',
							data: {file: file, username: $scope.username},
						});
						file.upload.then(function (response) {
							$timeout(function () {
								file.result = response.data;
								if (type == 'main_image') {
									$scope.image = response.data.image;
									$scope.image_thumbnail = response.data.image_thumbnail;
								}
								if (type == '1') {
									$scope.image1 = response.data.image;
									$scope.image_thumbnail1 = response.data.image_thumbnail;
								}
								if (type == '2') {
									$scope.image2 = response.data.image;
									$scope.image_thumbnail2 = response.data.image_thumbnail;
								}
								if (type == '3') {
									$scope.image3 = response.data.image;
									$scope.image_thumbnail3 = response.data.image_thumbnail;
								}
								if (type == '4') {
									$scope.image4 = response.data.image;
									$scope.image_thumbnail4 = response.data.image_thumbnail;
								}
								if (type == '5') {
									$scope.image5 = response.data.image;
									$scope.image_thumbnail5 = response.data.image_thumbnail;
								}
								if (type == '6') {
									$scope.image6 = response.data.image;
									$scope.image_thumbnail6 = response.data.image_thumbnail;
								}
								if (type == '7') {
									$scope.image7 = response.data.image;
									$scope.image_thumbnail7 = response.data.image_thumbnail;
								}
								if (type == '8') {
									$scope.image8 = response.data.image;
									$scope.image_thumbnail8 = response.data.image_thumbnail;
								}

							});
						}, function (response) {
							if (response.status > 0)
								$scope.errorMsg = response.status + ': ' + response.data;
						}, function (evt) {
							// Math.min is to fix IE which reports 200% sometimes
							file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
						});
					}
					else{
						alert('Sorry image size too big. We allow image size only 5MB.');
					}
				}
				else {
					alert('Invalid file. Support Image file only png/jpeg.');
				}
			}
		};

		/**
		 * start functionality pagination
		 */
		var params = {};
		$scope.currentPage = 1;
		//get another portions of data on page changed
		$scope.pageChanged = function() {
			$scope.pageSize = 10 * ( $scope.currentPage - 1 );
			params.start = $scope.pageSize;
			$scope.init(params);
		};

		$scope.product_image_thumbnail = [{
			image: '',
			image_thumbnail: ''
		}];

		function clear(){
			$scope.product_image_thumbnail = '';
			$scope.id = '';
			$scope.title = '';
			$scope.description = '';
			//$( "#entryCategories option:selected");
			tinymce.get('description').setContent('');
			$("#entryCategories option[value='']").attr('selected', true);
			$scope.products_location = '';
			$scope.manufacturer = '';
			$scope.image = '';
			$scope.image_thumbnail = '';
			$scope.price = '';
			$scope.image1 = '';
			$scope.image_thumbnail1 = '';
			$scope.image2 = '';
			$scope.image_thumbnail2 = '';
			$scope.image3 = '';
			$scope.image_thumbnail3 = '';
			$scope.image4 = '';
			$scope.image_thumbnail4 = '';
			$scope.image5 = '';
			$scope.image_thumbnail5 = '';
			$scope.image6 = '';
			$scope.image_thumbnail6 = '';
			$scope.image7 = '';
			$scope.image_thumbnail7 = '';
			$scope.image8 = '';
			$scope.image_thumbnail8 = '';
			$scope.picFile = '';
			$scope.picFile1 = '';
			$scope.picFile2 = '';
			$scope.picFile3 = '';
			$scope.picFile4 = '';
			$scope.picFile5 = '';
			$scope.picFile6 = '';
			$scope.picFile7 = '';
			$scope.picFile8 = '';
			// contact
			$scope.user.user_name = '';
			$scope.user.customers_telephone = '';
			$scope.user.customers_address = '';
			$scope.user.customers_location = '';
			$scope.user.customers_email_address = '';
		}
	}
]);