app.controller(
	'plan_text_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, 'alertify'
	, function ($scope, Restful, Services, $alertify){
		$scope.service = new Services();
		function init(params){
			Restful.get(params).success(function(data){
				console.log(data);
				$scope.plans = data;
				$scope.totalItems = data.count;
			});
		};
		init('api/PlanText');

		$scope.edit = function(params){
			$('#plan_text').modal('show');
			$scope.data = angular.copy(params);
		};

		$scope.save = function(){
			console.log($scope.data);
			$scope.isDisabled = true;
			if( $scope.data.id ){
				Restful.put('api/PlanText/' + $scope.data.id, $scope.data).success(function(data){
					init('api/PlanText/');
					console.log(data);
					$('#plan_text').modal('hide');
					$scope.isDisabled = false;
					$scope.service.alertMessage('<strong>Complete: </strong>Save Success.');
				});
			}else{
				Restful.post('api/PlanText/', $scope.data).success(function(data){
					console.log(data);
					init('api/PlanText');
					$('#plan_text').modal('hide')
					$scope.isDisabled = false;
					$scope.service.alertMessage('<strong>Complete: </strong>Save Success.');
				});
			}
		};

		$scope.remove = function($index, params){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("Are you sure you want to delete this plan?", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( 'api/PlanText/' + params.id, params ).success(function(data){
						$scope.disabled = true;
						console.log(data);
						$scope.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						$scope.plans.elements.splice($index, 1);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};

	}
]);