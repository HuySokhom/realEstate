app.controller(
	'vehicle_model_ctrl', [
	'$scope'
	, 'Factory'
	, 'Services'
	, '$location'
	, function ($scope, Factory, Services, $location){
		$scope.show_brand = true;
		$scope.header = 'Vehicle Model';
		$scope.add = function(){
			$scope.vehicle = '';
		};

		$scope.init = function(){
			Factory.getVehicles({Type: 'model'}).success(function(data){
				$scope.vehicle_model = data;
			});
			Factory.getVehicles({Type: 'brand'}).success(function(data){
				$scope.brand = data;
			});
		};
		$scope.init();
		
		$scope.edit = function(params){
			$scope.vehicle = angular.copy(params);
			$scope.brand.id = $scope.vehicle.brand[0].id;
		};
		
		$scope.save = function(params){
			var data = {
				name : $scope.vehicle.name,
				type : 'model',
				vehicle_brand_id: $scope.brand.id
			};
			if( $scope.vehicle.id ){
				data.id = $scope.vehicle.id;
				Factory.save(data).success(function(data){
					$scope.init();
					$('#brand').modal('hide');
				});
			}else{
				Factory.insert(data).success(function(data){
					$scope.init();
					$('#brand').modal('hide');
				});
			}
		};
		
		$scope.remove = function($index, id){
			var data = {
				id: id,
				type: 'model'
			};
			Factory.remove(data).success(function(data){
				$scope.vehicle_model.elements.splice($index, 1);
				console.log(data);
			});
		};
		
	}
]);