app.controller(
	'type_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, 'Services'
	, function ($scope, Restful, $location, Services){
		$scope.service = new Services();
		var url = 'api/NewsType/';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.types = data;console.log(data);
				$scope.totalItems = data.count;
			});
		};
		$scope.init();

		$scope.updateStatus = function(params){
			params.status === 1 ? params.status = 0 : params.status = 1;
			console.log(params);
			Restful.patch(url + params.id, params ).success(function(data) {
				console.log(data);
				$scope.service.alertMessage('<strong>Success: </strong>', 'Update Success.', 'success');
			});
		};

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
			Restful.delete( url + $scope.id ).success(function(data){
				$scope.disabled = true;
				$.notify({
					title: '<strong>Complete: </strong>',
					message: 'Delete Success.'
				},{
					type: 'success'
				});
				$scope.init();
				//$scope.news.elements.splice($scope.index, 1);
				$('#message').modal('hide');
			});

		};
		// search functionality
		$scope.search = function(){
			params.search_title = $scope.search_title;
			params.id = $scope.id;
			$scope.init(params);
		};
		// edit functionality
		$scope.edit = function(id){
			$location.path('/type/edit/' + id);
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
