app.controller(
	'village_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'alertify'
	, function ($scope, Restful, Services, $location, $alertify){
		$scope.service = new Services();
		var params = {pagination: 'yes'};
		var url = 'api/Village/';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.district = data;
				$scope.totalItems = data.count;
			});
			Restful.get('api/District/').success(function(data){
				$scope.districts = data;
			});
		};
		$scope.init(params);

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
							$scope.init(params);
						});
					}, function(ev) {
						// The click event is in the
						// event variable, so you can use
						// it here.
						ev.preventDefault();
					});

		};

		// save functionality
		$scope.save = function(){
			var data = {
				name_en: $scope.name,
				district_id: $scope.district_id
			};
			$scope.isDisabled = true;
			if( $scope.id ){
				Restful.put(url + $scope.id, data).success(function(data){
					$scope.init(params);
					$('#villagePopup').modal('hide');
					$scope.isDisabled = false;
					$scope.clear();
				});
			}else{
				Restful.post(url, data).success(function(data){
					$scope.init(params);
					$scope.clear();
					$('#villagePopup').modal('hide');
					$scope.isDisabled = false;
					$scope.name = "";
				});
			}
		};

		// search functionality
		$scope.search = function(){
			params.search_name = $scope.search_title;
			params.type = $scope.type_id;
			params.id = $scope.id;
			$scope.init(params);
		};
		// edit functionality
		$scope.edit = function(params){
			$scope.name = params.name_en;
			$scope.id = params.id;
			$scope.district_id = params.detail[0].id;
			$('#villagePopup').modal('show');
		};

		$scope.clear = function(){
			$scope.id = '';
			$scope.district_id = '';
			$scope.name = '';
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