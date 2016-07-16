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
		}
	]);