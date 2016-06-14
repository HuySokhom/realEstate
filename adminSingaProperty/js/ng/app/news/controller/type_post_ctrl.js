app.controller(
	'type_post_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, function ($scope, Restful, Services, $location){
		$scope.service = new Services();

		$scope.save = function(){
			// set object to save into news
			var data = {name_en: $scope.name_en, name_kh: $scope.name_kh};
			$scope.disabled = false;
			console.log(data);
			Restful.post('api/NewsType', data).success(function (data) {
				$scope.disabled = true;
				console.log(data);
				$scope.service.alertMessage('Complete: Save Success.');
				$location.path('news_type');
			});
		};

	}
]);