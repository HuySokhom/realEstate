app.controller(
	'news_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		$scope.language_id = $('#language_id').val();
		var params = {};
		var url = 'api/News';
		init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.news = data;
				$scope.totalItems = data.count;
			});
		};
		init(params);

		function initType(){
			Restful.get("api/NewsType").success(function(data){
				$scope.newsType = data;
			});
		}
		initType();

		/* set active link */
		$scope.activeMenu = "";
		$scope.setActive = function(item) {
			$scope.activeMenu = item;
			params.news_type_id = $scope.activeMenu;
			init(params);
		};

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
			$scope.pageSize = 10 * ( $scope.currentPage - 1 );
			params.start = $scope.pageSize;
			init(params);
		};
	}
]);
