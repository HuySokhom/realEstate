app.controller(
	'plan_price_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, 'alertify'
	, function ($scope, Restful, Services, $alertify){
		$scope.service = new Services();

		function init(params){
			Restful.get(params).success(function(data){
				console.log(data);
				$scope.planPrice = data;
				$scope.totalItems = data.count;
			});
		};

		init('api/PlanPrice');

		$scope.edit = function(params){
			$('#planPrice').modal('show');
			$scope.data = angular.copy(params);
		};

		$scope.save = function(){
			$scope.isDisabled = true;
			if( $scope.data.id ){
				Restful.put('api/PlanPrice/' + $scope.data.id, $scope.data).success(function(data){
					init('api/PlanPrice/');
					console.log(data);
					$('#planPrice').modal('hide');
					$scope.isDisabled = false;
					$scope.service.alertMessage('<strong>Complete: </strong>Save Success.');
				});
			}else{
				Restful.post('api/PlanPrice/', data).success(function(data){
					console.log(data);
					init('api/PartnerBanner');
					$('#banners').modal('hide')
					$scope.isDisabled = false;
				});
			}
		};


	}
]);