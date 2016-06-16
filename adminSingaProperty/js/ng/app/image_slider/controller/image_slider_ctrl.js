app.controller(
	'image_slider_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'Upload'
	, 'alertify'
	, '$timeout'
	, function ($scope, Restful, Services, $location, Upload, $alertify, $timeout){
		$scope.service = new Services();
		$scope.add = function(){
			$scope.image_slider = '';
			if($scope.picFile){
				$scope.picFile = null;
			}
		};
		$scope.totalItems = 0;
		function init(params){
			Restful.get(params).success(function(data){
				$scope.image_sliders = data;
				$scope.totalItems = data.count;
			});
		};
		init('api/ImageSlider');

		$scope.edit = function(params){
			$('#imagePopup').modal('show');
			$scope.image_slider = angular.copy(params);
			if($scope.picFile){
				$scope.picFile = null;
			}
		};

		$scope.save = function(){
			var data = {
				text: $scope.image_slider.text,
				image: $scope.image_slider.image,
				image_thumbnail: $scope.image_slider.image_thumbnail,
				sort_order: $scope.image_slider.sort_order
			};
			$scope.isDisabled = true;
			if( $scope.image_slider.id ){
				Restful.put('api/ImageSlider/' + $scope.image_slider.id, data).success(function(data){
					init('api/ImageSlider/');
					$('#imagePopup').modal('hide');
					$scope.isDisabled = false;
				});
			}else{
				Restful.post('api/ImageSlider/', data).success(function(data){
					init('api/ImageSlider');console.log(data);
					$('#imagePopup').modal('hide')
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

		/**
		 * start functionality pagination
		 */
		var params = {};
		$scope.currentPage = 1;
		//get another portions of data on page changed
		$scope.pageChanged = function() {
			$scope.pageSize = 10 * ( $scope.currentPage - 1 );
			params.start = $scope.pageSize;
			init(params);
		};
	}
]);