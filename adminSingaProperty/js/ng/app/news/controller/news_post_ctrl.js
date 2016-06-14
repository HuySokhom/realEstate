app.controller(
	'news_post_ctrl', [
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

		// init news type
		$scope.initNewsType = function(){
			Restful.get("api/NewsType").success(function(data){
				$scope.newsType = data;
			});
		};
		$scope.initNewsType();

		$scope.save = function(){
			// set object to save into news
			var data = {
				news: {
					image: $scope.image,
					image_thumbnail: $scope.image_thumbnail,
					news_type_id: $scope.news_type_id
				},
				news_description: [
					{
						title: $scope.title_en,
						content: $scope.content_en,
						language_id: 1
					},
					{
						title: $scope.title_kh,
						content: $scope.content_kh,
						language_id: 2
					}
				]
			};
			$scope.disabled = false;
			//console.log(data);
			Restful.post('api/News', data).success(function (data) {
				$scope.disabled = true;
				//console.log(data);
				$scope.service.alertMessage('Complete Save Success.');
				$location.path('news');
			});
		};

		//functionality upload
		$scope.uploadPic = function(file) {
			if (file) {
				file.upload = Upload.upload({
					url: 'api/ImageUpload',
					data: {file: file, username: $scope.username},
				});console.log(file);
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

	}
]);