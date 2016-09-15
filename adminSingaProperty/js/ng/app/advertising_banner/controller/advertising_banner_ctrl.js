app.controller(
	'advertising_banner_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'Upload'
	, 'alertify'
	, '$timeout'
	, function ($scope, Restful, Services, $location, Upload, $alertify, $timeout){
		$scope.service = new Services();
		$scope.data = {};
		$scope.add = function(){
			$scope.data = {};
			if($scope.picFile){
				$scope.picFile = null;
			}
		};

		function init(params){
			Restful.get(params).success(function(data){
				console.log(data);
				$scope.banners = data;
				$scope.totalItems = data.count;
			});
		};
		init('api/AdvertisingBanner');

		$scope.edit = function(params){
			$('#banners').modal('show');
			if($scope.picFile){
				$scope.picFile = null;
			}
			$scope.data = params;
			console.log(params);		
		};

		$scope.save = function(){			
			console.log($scope.data);
			$scope.isDisabled = true;
			if( $scope.data.id ){
				Restful.put('api/AdvertisingBanner/' + $scope.data.id, $scope.data).success(function(data){
					init('api/AdvertisingBanner/');
					console.log(data);
					$('#banners').modal('hide');
					$scope.isDisabled = false;
				});
			}else{
				Restful.post('api/AdvertisingBanner/', $scope.data).success(function(data){
					console.log(data);
					init('api/AdvertisingBanner');
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
					Restful.delete( 'api/AdvertisingBanner/' + params.id, params ).success(function(data){
						$scope.disabled = true;console.log(data);
						$scope.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						$scope.banners.elements.splice($index, 1);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};

		// update status 
		$scope.updateStatus = function(params){
			params.status === 1 ? params.status = 0 : params.status = 1;
			var data = { status: params.status, name: "update_status"};
			Restful.patch('api/AdvertisingBanner/' + params.id, data).success(function(data){
				console.log(data);
				$scope.service.alertMessage('<strong>Complete: </strong> Update Status Success.');
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
						$scope.data.image = response.data.image;
						//$scope.data.image_thumbnail = response.data.image_thumbnail;
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