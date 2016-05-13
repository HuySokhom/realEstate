app.controller(
	'vehicle_seat_ctrl', [
	'$scope'
	, 'Factory'
	, 'Services'
	, function ($scope, Factory, Services){
		
		$scope.header = 'Vehicle Seat';
		$scope.add = function(){
			$scope.vehicle = '';
		};

		$scope.init = function(){
			Factory.getVehicles({Type: 'seat'}).success(function(data){
				$scope.vehicle_seat = data;
			});
		};
		$scope.init();
		
		$scope.edit = function(params){
			$scope.vehicle = angular.copy(params);
		};

		$scope.save = function(params){
			var data = {
				name : $scope.vehicle.name,
				type : 'seat'
			};
			if( $scope.vehicle.id ){
				// add new object model
				$scope.vehicle.type = 'seat';
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
				type: 'seat'
			};
			Factory.remove(data).success(function(data){
				$scope.vehicle_seat.elements.splice($index, 1);
				console.log(data);
			}); 
		};
		
	}
]);