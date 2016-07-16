app.controller(
	'agent_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		var url = 'api/Agent';
		var params = {};
		$scope.initAgent = function(params){
			Restful.get(url, params).success(function(data){
				$scope.agents = data;
				$scope.totalItems = data.count;
			});
		};
		$scope.initAgent();

		/* function link page single */
		$scope.link = function(typeId, newId){
			$location.path(typeId + '/' + newId);
		};

		/**
		 * start functionality pagination
		 */
		$scope.currentPage = 1;
		//get another portions of data on page changed
		$scope.pageChanged = function() {
			$scope.pageSize = 9 * ( $scope.currentPage - 1 );
			params.start = $scope.pageSize;
			$scope.initAgent(params);
		};
	}
]);
