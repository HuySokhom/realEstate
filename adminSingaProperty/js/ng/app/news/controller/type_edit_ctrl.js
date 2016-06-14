app.controller(
	'type_edit_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, 'Services'
	, '$location'
	, 'Upload'
	, '$timeout'
	, function ($scope, Restful, $stateParams, Services, $location, Upload, $timeout){
		var url = 'api/NewsType/';
		$scope.service = new Services();

		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				console.log(data);
				$scope.name_kh = data.elements[0].name_kh;
				$scope.name_en = data.elements[0].name_en;
			});
		};
		$scope.init();

		// update functionality
		$scope.save = function(){
			// set object to save into news
			var data = {
				name_kh: $scope.name_kh,
				name_en: $scope.name_en
			};
			$scope.disabled = false;

			Restful.put('api/NewsType/' + $stateParams.id, data).success(function (data) {
				$scope.disabled = true;console.log(data);
				$scope.service.alertMessage('Complete: Update Success.');
				$location.path('news_type');
			});
		};

	}
]);