app.controller(
	'vehicle_type_ctrl', [
	'$scope'
	, 'Factory'
	, 'Services'
	, function ($scope, Factory, Services){
		
		$scope.header = 'Vehicle Type';
		$scope.add = function(){
			$scope.vehicle = '';
		};

		$scope.init = function(){
			Factory.getVehicles().success(function(data){
				$scope.vehicle_type = data;
			});
		};
		$scope.init();
		
		$scope.edit = function(params){
			$scope.vehicle = angular.copy(params);
		};

		$scope.save = function(params){
			var data = {
				name : $scope.vehicle.name,
				type : 'type'
			};
			if( $scope.vehicle.id ){
				// add new object model
				$scope.vehicle.type = 'type';
				Factory.save($scope.vehicle).success(function(data){
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
				type: 'type'
			};
			Factory.remove(data).success(function(data){
				$scope.vehicle_type.elements.splice($index, 1);
				console.log(data);
			}); 
		};
		
	}
]);