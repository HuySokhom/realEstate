app.controller(
	'detail_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, '$sce'
	, function ($scope, Restful, $stateParams, $sce){

		var url = 'api/Agent/';
		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				$scope.agent = data.elements[0];
			});
		};
		$scope.init();

		// init products user
		function initProductUser($params) {
			Restful.get('api/Products/' + $stateParams.id, params).success(function (data) {
				$scope.productsAgents = data.elements;
				$scope.totalItems = data.count;
			});
		}
		initProductUser(params);
		/**
		 * start functionality pagination
		 */
		var params = {};
		$scope.currentPage = 1;
		//get another portions of data on page changed
		$scope.pageChanged = function() {
			$scope.pageSize = 9 * ( $scope.currentPage - 1 );
			params.start = $scope.pageSize;
			initProductUser(params);
		};
	}
]);