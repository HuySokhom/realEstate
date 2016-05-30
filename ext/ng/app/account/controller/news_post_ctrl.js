app.controller(
	'news_post_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, function ($scope, Restful, Services, $location){
		$scope.service = new Services();
		// init tinymce
		tinymce.init({
			selector:'textarea',
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern media"
			],
			toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			paste_data_images: true
		});
		$scope.save = function(){
			// set object to save into news
			var data = {
				news: [
					{
						title: $scope.title_en,
						content: tinymce.get('content_en').getContent(),
						language_id: 1
					},
					{
						title: $scope.title_kh,
						content: tinymce.get('content_kh').getContent(),
						language_id: 2
					}
				]
			};
			$scope.disabled = false;
			console.log(data);
			Restful.save('api/Session/User/News', data).success(function (data) {
				$scope.disabled = true;
				console.log(data);
				$scope.service.alertMessage('Complete', 'Save Success.', 'success');
				$location.path('manage_news');
			});
		};

	}
]);