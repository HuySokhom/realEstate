app.controller(
	'content_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, 'Services'
	, 'alertify'
	, function ($scope, Restful, $location, Services, $alertify){
		$scope.service = new Services();
		var url = 'api/Content/';
		$scope.init = function(params){
			Restful.get(url).success(function(data){
				$scope.contents = data;
			});
		};
		$scope.init();

		// save functionality
		$scope.save = function(){
			var data = {
				title: $scope.title,
				content: $scope.content,
				language_id: $scope.language_id,
			};
			$scope.isDisabled = true;
			if( $scope.id ){
				Restful.put(url + $scope.id, data).success(function(data){
					$scope.init(params);
					$('#districtPopup').modal('hide');
					$scope.isDisabled = false;
					$scope.clear();
					$scope.service.alertMessage('<strong>Complete: </strong>Update Success.');
				});
			}else{
				Restful.post(url, data).success(function(data){
					$scope.init(params);
					$scope.clear();
					$('#districtPopup').modal('hide');
					$scope.isDisabled = false;
					$scope.name = "";
					$scope.service.alertMessage('<strong>Complete: </strong>Save Success.');
				});
			}
		};

		// edit functionality
		$scope.edit = function(params){
			$scope.name = params.content;
			$scope.id = params.id;
			$scope.province_id = params.title;
			$('#districtPopup').modal('show');
		};

	}
]);
