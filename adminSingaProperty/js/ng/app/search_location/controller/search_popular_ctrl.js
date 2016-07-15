app.controller(
	'search_popular_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'alertify'
	, function ($scope, Restful, Services, $location, $alertify){
		$scope.service = new Services();
		var params = {pagination: 'yes'};
		var url = 'api/SearchLocation/';
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
					.confirm("Are you sure want to delete this?", function (ev) {
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
		$scope.save = function(params){
			//console.log(params);
			Restful.post(url, params).success(function(data){
				$scope.init();
				$scope.clear();
				$scope.service.alertMessage('<strong>Complete: </strong>Save Success.');
			});

		};

		/****** Province Filter *******/
		$scope.province_list = {};
		$scope.refreshProvinceList = function(province_list) {
			var params = {search_name: province_list, pagination: 'yes'};
			return Restful.get('api/Location', params).then(function(response) {
				$scope.provinceList = response.data.elements;
			});
		};

		/****** District Filter *******/
		$scope.district_list = {};
		$scope.refreshDistrictList = function(district_list) {
			var params = {search_name: district_list, pagination: 'yes'};
			return Restful.get('api/District', params).then(function(response) {
				$scope.districtList = response.data.elements;
			});
		};

		/****** Village Filter *******/
		$scope.village_list = {};
		$scope.refreshVillageList = function(village_list) {
			var params = {search_name: village_list, pagination: 'yes'};
			return Restful.get('api/Village', params).then(function(response) {
				$scope.villageList = response.data.elements;
			});
		};

		$scope.clear = function(){
			$scope.province_list = {};
			$scope.district_list = {};
			$scope.village_list = {};
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