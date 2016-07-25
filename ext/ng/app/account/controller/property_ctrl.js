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
				$scope.products_post = data;
				//console.log(data);
				$scope.totalItems = data.count;
			});
			Restful.get("api/Category").success(function(data){
				$scope.categoryList = data;
			});
		};
		$scope.init();
		$scope.disabled = true;

		$scope.edit = function(id){
			$location.path("/manage_property/edit/" + id);
		};

		$scope.refreshDate = function(params){
			Restful.patch('api/Session/User/ProductPost/' + params.products_id).success(function(data){
				$scope.init();
				$scope.service.alertMessage('<strong>Complete: </strong> Update Product Refresh Success.');
			});
		};

		$scope.promote = function(params){console.log(params);
			var data = { products_promote: params.products_promote, name: "promote_product"};
			Restful.patch('api/Session/User/ProductPost/' + params.products_id, data).success(function(data){
				console.log(data);
				if(data == 'success'){
					$scope.service.alertMessage('<strong>Complete: </strong> Update Status Success.');
				}else if (data == 'limit'){
					$scope.service.alertMessagePromt('<strong>Warning: </strong> Your Plan Has Limit Boost Property.');
				}else{
					$scope.service.alertMessagePromt('<strong>Warning: </strong> Please Upgrade Your Plan To Boost Property.');
				}
				$scope.init();
			});
		};

		$scope.updateStatus = function(params){
			params.products_status == 1 ? params.products_status = 0 : params.products_status = 1;
			var data = { status: params.products_status, name: "update_status"};
			Restful.patch('api/Session/User/ProductPost/' + params.products_id, data).success(function(data){
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
						$scope.products_post.elements.splice($index, 1);
						$scope.init(params);
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
			params.search_title = $scope.search_title;
			params.id = $scope.id;
			params.type = $scope.category_id;
			$scope.init(params);
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