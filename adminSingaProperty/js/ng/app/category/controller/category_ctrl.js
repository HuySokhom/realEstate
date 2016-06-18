app.controller(
	'category_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'Upload'
	, 'alertify'
	, '$timeout'
	, function ($scope, Restful, Services, $location, Upload, $alertify, $timeout){
		$scope.service = new Services();
		var url = "api/Category/";
		var params = {};
		function init(params){
			Restful.get(url, params).success(function(data){
				$scope.category = data;
				$scope.totalItems = data.count;
			});
		};
		init(params);

		$scope.clear = function(){
			$scope.name_en = '';
			$scope.name_kh = '';
			$scope.sort_order = '';
			$scope.parent_id = '';
			$scope.id = '';
		};

		$scope.edit = function(params){
			$('#categoryPopup').modal('show');
			var temp = angular.copy(params);
			$scope.name_en = temp.detail[0].categories_name;
			$scope.name_kh = temp.detail[1].categories_name;
			$scope.parent_id = temp.parent_id;
			$scope.id = temp.categories_id;
			$scope.sort_order = temp.sort_order;
		};

		$scope.save = function(){
			var data = {
				category: [{
					parent_id: $scope.parent_id,
					sort_order: $scope.sort_order,
				}],
				detail: [
					{
						categories_name: $scope.name_en,
						language_id: 1
					},{
						categories_name: $scope.name_kh,
						language_id: 2
					}
				]
			};console.log(data);
			$scope.isDisabled = true;
			if( $scope.id ){
				Restful.put(url + $scope.id, data).success(function(data){
					init(params);
					$('#categoryPopup').modal('hide');
					$scope.service.alertMessage('<strong>Complete: </strong>Save Success.');
					$scope.isDisabled = false;
				});
			}else{
				Restful.post(url, data).success(function(data){
					init(params);
					$scope.service.alertMessage('<strong>Complete: </strong>Save Success.');
					$('#categoryPopup').modal('hide')
					$scope.isDisabled = false;
				});
			}
		};

		$scope.remove = function($index, params){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("<b>Waring: </b>If you delete this category it will " +
						"delete all product that use this category.", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( url + params.categories_id, params ).success(function(data){
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

	}
]);