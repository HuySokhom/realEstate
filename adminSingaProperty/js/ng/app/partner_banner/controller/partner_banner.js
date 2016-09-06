app.controller(
	'partner_banner_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, 'Upload'
	, 'alertify'
	, '$timeout'
	, function ($scope, Restful, Services, Upload, $alertify, $timeout){
		$scope.service = new Services();

		$scope.add = function(){
			$scope.banner = '';
			if($scope.picFile){
				$scope.picFile = null;
			}
		};

		function init(params){
			Restful.get(params).success(function(data){
				$scope.banners = data;
				$scope.totalItems = data.count;
			});
		};
		init('api/PartnerBanner');

		$scope.edit = function(params){
			$('#banners').modal('show');
			$scope.banner = angular.copy(params);
			if($scope.picFile){
				$scope.picFile = null;
			}
		};

		$scope.save = function(){
			var data = {
				title: $scope.banner.title,
				image: $scope.banner.image,
				link: $scope.banner.link,
				sort_order: $scope.banner.sort_order
			};
			$scope.isDisabled = true;
			if( $scope.banner.id ){
				Restful.put('api/ImageSlider/' + $scope.banner.id, data).success(function(data){
					init('api/ImageSlider/');
					$('#banners').modal('hide');
					$scope.isDisabled = false;
				});
			}else{
				Restful.post('api/ImageSlider/', data).success(function(data){
					init('api/ImageSlider');console.log(data);
					$('#banners').modal('hide')
					$scope.isDisabled = false;
				});
			}
		};

		$scope.remove = function($index, params){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("Are you sure you want to delete this image?", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( 'api/ImageSlider/' + params.id, params ).success(function(data){
						$scope.disabled = true;console.log(data);
						$scope.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						$scope.image_sliders.elements.splice($index, 1);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};

		//functionality upload
		$scope.uploadPic = function(file) {
			if (file) {
				file.upload = Upload.upload({
					url: 'api/ImageUpload',
					data: {file: file, username: $scope.username},
				});
				file.upload.then(function (response) {
					$timeout(function () {
						file.result = response.data;
						$scope.image_slider.image = response.data.image;
						$scope.image_slider.image_thumbnail = response.data.image_thumbnail;
						//file.result.substring(1, file.result.length - 1);
					});
				}, function (response) {
					if (response.status > 0)
						$scope.errorMsg = response.status + ': ' + response.data;
				}, function (evt) {
					// Math.min is to fix IE which reports 200% sometimes
					file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
				});
			}
		};

	}
]);