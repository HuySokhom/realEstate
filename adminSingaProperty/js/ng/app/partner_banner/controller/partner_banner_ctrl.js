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
			$scope.title = '';
			$scope.image_thumbnail = '';
			$scope.link = '';
			$scope.sort_order = '';
			$scope.id = '';
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
		init('api/PartnerBanner');

		$scope.edit = function(params){
			$('#banners').modal('show');
			if($scope.picFile){
				$scope.picFile = null;
			}
			$scope.title = params.title;
			$scope.id = params.id;
			console.log(params);
			$scope.image_thumbnail = params.image_thumbnail;
			$scope.link = params.link;
			$scope.sort_order = params.sort_order;
			
		};

		$scope.save = function(){
			var data = {
				title: $scope.title,
				image: $scope.image,
				image_thumbnail: $scope.image_thumbnail,
				link: $scope.link,
				sort_order: $scope.sort_order
			};
			console.log(data);
			$scope.isDisabled = true;
			if( $scope.id ){
				Restful.put('api/PartnerBanner/' + $scope.id, data).success(function(data){
					init('api/PartnerBanner/');
					console.log(data);
					$('#banners').modal('hide');
					$scope.isDisabled = false;
				});
			}else{
				Restful.post('api/PartnerBanner/', data).success(function(data){
					console.log(data);
					init('api/PartnerBanner');
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
					Restful.delete( 'api/PartnerBanner/' + params.id, params ).success(function(data){
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
						$scope.image = response.data.image;
						$scope.image_thumbnail = response.data.image_thumbnail;
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