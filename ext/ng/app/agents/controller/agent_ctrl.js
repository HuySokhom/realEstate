app.controller(
	'agent_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		var url = 'api/Agent';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.agents = data;
				$scope.totalItems = data.count;console.log(data);
			});
		};
		$scope.init();

		/* function link page single */
		$scope.link = function(typeId, newId){
			$location.path(typeId + '/' + newId);
		};

		/**
		 * start functionality pagination
		 */
		var params = {};
		$scope.currentPage = 1;
		//get another portions of data on page changed
		$scope.pageChanged = function() {
			$scope.pageSize = 10 * ( $scope.currentPage - 1 );
			params.start = $scope.pageSize;
			$scope.init(params);
		};
	}
]);
