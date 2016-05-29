app.controller(
	'news_post_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, function ($scope, Restful, Services, $location){
		$scope.service = new Services();

		$scope.save = function(){
			// set object to save into news
			var params = {
				news: [
					{
						title: $scope.title_en,
						content: tinymce.get('description_en').getContent(),
						language_id: 1
					},
					{
						products_name: $scope.title_kh,
						products_description: tinymce.get('description_kh').getContent(),
						language_id: 2
					}
				]
			};
			$scope.disabled = false;
			Restful.save('api/Session/User/News', params).success(function (data) {
				$scope.init();
				$scope.disabled = true;
				$scope.service.alertMessage('Complete', 'Save Success.', 'success');
				$location.path('manage_news');
			});
		};

	}
]);