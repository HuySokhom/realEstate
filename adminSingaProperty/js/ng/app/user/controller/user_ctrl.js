app.controller(
	'user_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, 'alertify'
	, '$location'
	, function ($scope, Restful, Services, $alertify, $location){
		$scope.service = new Services();
		var url = 'api/Customer/';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.users = data;
				$scope.totalItems = data.count;
			});
		};
		$scope.init();
		$scope.sortType = [
			{
				id: 0,
				name: 'Free Plan'
			},
			{
				id: 1,
				name: 'Basic Plan'
			},
			{
				id: 2,
				name: 'Premium Plan'
			},
			{
				id: 3,
				name: 'Pro Plan'
			},
		];
		$scope.updateStatus = function(params){
			params.is_agency == 1 ? params.is_agency = 0 : params.is_agency = 1;
			Restful.patch(url + params.id, params ).success(function(data) {
				$scope.service.alertMessage('<strong>Success: </strong>Update Success.');
			});
		};

		// remove functionality
		$scope.remove = function(id, $index){
			$scope.id = id;
			$scope.index = $index;

			$alertify.okBtn("Ok")
					.cancelBtn("Cancel")
					.confirm("Are you sure want to delete this news?", function (ev) {
						// The click event is in the
						// event variable, so you can use
						// it here.
						ev.preventDefault();
						Restful.delete( url + $scope.id ).success(function(data){
							$scope.disabled = true;
							$scope.service.alertMessage('<strong>Complete: </strong>Delete Success.');
							$scope.init();
							//$scope.news.elements.splice($scope.index, 1);
							//$('#message').modal('hide');
						});
					}, function(ev) {
						// The click event is in the
						// event variable, so you can use
						// it here.
						ev.preventDefault();
					});

		};
		// search functionality
		$scope.search = function(){
			params.search_name = $scope.search_name;
			params.id = $scope.id;
			params.type = $scope.type;
			params.plan = $scope.property_plan;
			console.log(params);
			$scope.init(params);
		};
		// edit functionality
		$scope.edit = function(id){
			$location.path('/user/edit/' + id);
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