app.controller(
	'news_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		var url = 'api/News';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.news = data;console.log(data);
				$scope.totalItems = data.count;
			});
		};
		$scope.init();
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
