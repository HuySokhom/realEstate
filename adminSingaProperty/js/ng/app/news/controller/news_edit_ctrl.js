app.controller(
	'news_edit_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, 'Services'
	, '$location'
	, 'Upload'
	, '$timeout'
	, function ($scope, Restful, $stateParams, Services, $location, Upload, $timeout){
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

		var url = 'api/News/';
		$scope.service = new Services();

		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				$scope.news = data.elements[0].detail;
				$scope.news_type_id = data.elements[0].type[0].id;
				$scope.title_en = data.elements[0].detail[0].title;
				$scope.title_kh = data.elements[0].detail[1].title;
				$scope.content_en = data.elements[0].detail[0].content;
				$scope.content_kh = data.elements[0].detail[1].content;
				$scope.image = data.elements[0].image;
				$scope.image_thumbnail = data.elements[0].image_thumbnail;
				$scope.create_by = data.elements[0].create_by;
				$scope.create_date = data.elements[0].create_date;
			});
		};
		$scope.init();

		// update functionality
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

			Restful.put('api/News/' + $stateParams.id, data).success(function (data) {
				$scope.disabled = true;
				$scope.service.alertMessage('Complete: Update Success.');
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