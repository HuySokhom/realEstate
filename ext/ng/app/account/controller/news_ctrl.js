app.controller(
	'news_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		var url = 'api/Session/User/News';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.news = data;console.log(data);
				$scope.totalItems = data.count;
			});
		};
		$scope.init();

		// remove functionality
		$scope.id = '';
		$scope.index = '';
		$scope.remove = function(id, $index){
			$scope.id = id;
			$scope.index = $index;
		};
		$scope.disabled = true;
		$scope.confirmDelete = function(){
			$scope.disabled = false;
			Restful.delete( 'api/Session/User/News/' + $scope.id ).success(function(data){
				$scope.disabled = true;
				$.notify({
					title: '<strong>Complete: </strong>',
					message: 'Delete Success.'
				},{
					type: 'success'
				});
				//$scope.init();
				$scope.news.elements.splice($scope.index, 1);
				$('#message').modal('hide');
			});

		};
		// search functionality
		$scope.search = function(){
			params.search_title = $scope.search_title;
			params.id = $scope.id;
			console.log(params);
			$scope.init(params);
		};
		// edit functionality
		$scope.edit = function(id){
			$location.path('/manage_news/edit/' + id);
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
