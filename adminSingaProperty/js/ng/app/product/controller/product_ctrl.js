app.controller(
	'product_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'alertify'
	, function ($scope, Restful, Services, $location, $alertify){
		$scope.service = new Services();
		var params = {};
		var url = 'api/Product/';
		function init(params){
			Restful.get(url, params).success(function(data){
				$scope.products = data;
				$scope.totalItems = data.count;
			});
		};
		init(params);

		$scope.edit = function(params){
			console.log(params);
		};

		$scope.remove = function($index, params){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("Are you sure you want to delete this image?", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( url + params.id, params ).success(function(data){
						$scope.disabled = true;console.log(data);
						$scope.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						$scope.image_sliders.elements.splice($index, 1);
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
			init(params);
		};
	}
]);