app.controller(
	'account_edit_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, function ($scope, Restful, Services, $location){
		var url = 'api/Session/Customer/';
		$scope.service = new Services();
		// init tiny option
		$scope.tinymceOptions = {};
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.user_name = data.elements[0].user_name;
				$scope.email = data.elements[0].customers_email_address;
				$scope.location = data.elements[0].customers_location;
				$scope.telephone = data.elements[0].customers_telephone;
				$scope.detail = data.elements[0].detail;
				$scope.address = data.elements[0].customers_address;
				$scope.photo = data.elements[0].photo;
				console.log(data);
			});
		};
		$scope.init();

		// update functionality
		$scope.save = function(){
			// set object to save into news
			var data = {
				user_name: $scope.user_name,
				customers_email_address: $scope.address,
				customers_location: $scope.location,
				customers_telephone: $scope.telephone,
				detail: $scope.detail,
				customers_address: $scope.address,
				photo: $scope.photo
			};
			console.log(data);
			$scope.disabled = false;

			Restful.put('api/Session/Customer/', data).success(function (data) {
				$scope.disabled = true;
				$scope.service.alertMessage('Complete', 'Update Success.', 'success');
				$location.path('account');
			});
		};
	}
]);