app.controller(
	'product_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'alertify'
	, function ($scope, Restful, Services, $location, $alertify){
		$scope.service = new Services();
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
		var params = {};
		var url = 'api/Product/';
		function init(params){
			Restful.get(url, params).success(function(data){
				$scope.products = data;
				$scope.totalItems = data.count;
			});
			Restful.get("api/Category").success(function(data){
				$scope.categoryList = data;
			});
			Restful.get("api/Customer").success(function(data){
				$scope.customerList = data;
			});
		};
		init(params);

		$scope.edit = function(params){
			console.log(params);
			$location.path('/product/edit/' + params.id);
		};

		$scope.remove = function(id){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("Are you sure you want to delete this product?", function (ev) {
					ev.preventDefault();
					Restful.delete( url + id, params ).success(function(data){
						$scope.disabled = true;
						$scope.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						//$scope.products.elements.splice($index, 1);
						init(params);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};

		$scope.edit = function(id){
			$location.path("/product/edit/" + id);
		};

		$scope.refreshDate = function(param){
			Restful.patch(url + param.id).success(function(data){
				init(params);
			});
		};

		$scope.updateStatus = function(params){
			params.products_status == 1 ? params.products_status = 0 : params.products_status = 1;
			var data = { status: params.products_status, name: "update_status"};
			Restful.patch(url + params.id, data).success(function(data){console.log(data);
				$scope.service.alertMessage('<strong>Complete: </strong> Update Status Success.');
			});
		};

		$scope.link = function(id){
			window.open('-p-' + id + '.html','_blank');
		};
		// search functionality
		$scope.search = function(){
			params.search_title = $scope.search_title;
			params.id = $scope.id;
			params.type = $scope.category_id;
			params.sort_by = $scope.sort_by;
			params.customer_id = $scope.customer_id;
			init(params);
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