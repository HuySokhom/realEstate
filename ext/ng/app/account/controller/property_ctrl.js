app.controller(
	'property_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, 'Upload'
	, '$timeout'
	, '$location'
	, 'alertify'
	, function ($scope, Restful, Services, Upload, $timeout, $location, $alertify){
		$scope.service = new Services();
		var params = {pagination: 'yes'};
		var url = 'api/Session/User/ProductPost/';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.products_post = data;console.log(data);
				$scope.totalItems = data.count;
			});
			Restful.get("api/Category").success(function(data){
				$scope.categoryList = data;console.log(data);
			});
		};
		$scope.init();
		$scope.disabled = true;

		$scope.edit = function(id){
			$location.path("/manage_property/edit/" + id);
		};

		$scope.refreshDate = function(params){
			Restful.patch('api/Session/User/ProductPost/'+params.id).success(function(data){
				$scope.init();
			});
		};

		$scope.updateStatus = function(params){
			params.products_status == 1 ? params.products_status = 0 : params.products_status = 1;
			var data = { status: params.products_status, name: "update_status"};
			Restful.patch('api/Session/User/ProductPost/'+params.id, data).success(function(data){
				$scope.service.alertMessage('<strong>Complete: </strong> Update Status Success.');
			});
		};

		$scope.link = function(id){
			window.open('-p-' + id + '.html','_blank');
		};

		$scope.remove = function($index, id){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("<b>Waring: </b>" +
						"Are you sure want to delete this product.", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( url + id ).success(function(data){
						$scope.disabled = true;
						$scope.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						$scope.category.elements.splice($index, 1);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};

		/**
		 * start functionality pagination
		 */
		$scope.currentPage = 1;
		//get another portions of data on page changed
		$scope.pageChanged = function() {
			$scope.pageSize = 10 * ( $scope.currentPage - 1 );
			params.start = $scope.pageSize;
			$scope.init(params);
		};
	}
]);