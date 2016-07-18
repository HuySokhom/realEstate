app.controller(
	'index_ctrl', [
		'$scope'
		, 'Restful'
		, 'Services'
		, '$location'
		, function ($scope, Restful, Services, $location){
			Restful.get("api/Index").success(function(data){
				$scope.index = data;
			});
			$scope.gmtValue = 5.45;
			$scope.startTimeValue = 1430990693334;
			$scope.format = 'dd-MMM-yyyy hh:mm:ss a';
		}
	]);