app.controller(
	'image_slider_ctrl', [
	'$scope'
	, 'Factory'
	, 'Services'
	, 'Upload'
	, '$timeout'
	, function ($scope, Factory, Services, Upload, $timeout){
		$scope.add = function(){
			$scope.image_slider = '';
			if($scope.picFile){
				$scope.picFile = null;
			}
		};
		$scope.totalItems = 0;
		function init(params){
			Factory.get(params).success(function(data){
				$scope.image_sliders = data;
				$scope.totalItems = data.count;
			});
		};
		init();
		
		$scope.edit = function(params){
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
				Factory.save(data, $scope.image_slider.id).success(function(data){
					init();
					$('#brand').modal('hide');
					$scope.isDisabled = false;
				});
			}else{
				Factory.insert(data).success(function(data){
					init();
					$('#brand').modal('hide')
					$scope.isDisabled = false;
				});
			}
		};
		
		$scope.remove = function($index, id){
			if (confirm('Are you sure you want to delete this image?')) {
				var data = {
					id: id
				};
				Factory.remove(data).success(function(data){
					$scope.image_sliders.elements.splice($index, 1);
				});
			}
		};

		//functionality upload
		$scope.uploadPic = function(file) {
			if (file) {
				file.upload = Upload.upload({
					url: 'api/ImageUpload',
					data: {file: file, username: $scope.username},
				});console.log(file);
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
		}

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