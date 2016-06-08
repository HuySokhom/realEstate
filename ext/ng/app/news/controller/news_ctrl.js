app.controller(
	'news_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		var url = 'api/News';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.news = data;
				$scope.totalItems = data.count;
			});

			Restful.get("api/NewsType").success(function(data){
				$scope.newsType = data;console.log(data);
			});

		};
		$scope.init();

		/* set active link */
		$scope.activeMenu = "";
		$scope.setActive = function(item) {
			$scope.activeMenu = item;

		};

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
