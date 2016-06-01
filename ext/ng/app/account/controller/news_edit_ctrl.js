app.controller(
	'news_edit_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, 'Services'
	, '$location'
	, function ($scope, Restful, $stateParams, Services, $location){
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

		var url = 'api/Session/User/News/';
		$scope.service = new Services();

		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				$scope.news = data.elements[0].detail;
				$scope.title_en = data.elements[0].detail[0].title;
				$scope.title_kh = data.elements[0].detail[1].title;
				$scope.content_en = data.elements[0].detail[0].content;
				$scope.content_kh = data.elements[0].detail[1].content;
			});
		};
		$scope.init();

		// update functionality
		$scope.save = function(){
			// set object to save into news
			var data = {
				news: [
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
			Restful.put('api/Session/User/News/' + $stateParams.id, data).success(function (data) {
				$scope.disabled = true;
				$scope.service.alertMessage('Complete', 'Update Success.', 'success');
				$location.path('manage_news');
			});
		};

	}
]);