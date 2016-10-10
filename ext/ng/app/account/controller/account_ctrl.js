app.controller(
	'account_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$anchorScroll'
	, function ($scope, Restful, Services, $anchorScroll){
		$anchorScroll();
		$scope.language_id = $('#language_id').val();
		var url = 'api/Session/Customer/';
		$scope.service = new Services();
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.user_name = data.elements[0].user_name;
				$scope.email = data.elements[0].customers_email_address;
				$scope.location = data.elements[0].customers_location;
				$scope.telephone = data.elements[0].customers_telephone;
				$scope.detail = data.elements[0].detail;
				$scope.address = data.elements[0].customers_address;
				$scope.photo_thumbnail = data.elements[0].photo_thumbnail;
				$scope.customers_plan = data.elements[0].customers_plan;
				$scope.plan_date = data.elements[0].plan_date;
				$scope.plan_expire = data.elements[0].plan_expire;
				$scope.fax = data.elements[0].customers_fax;
				$scope.type = data.elements[0].user_type;
				$scope.location_name = data.elements[0].location_detail[0].name;
				//console.log(data);
			});
		};
		$scope.init();

	}
]);