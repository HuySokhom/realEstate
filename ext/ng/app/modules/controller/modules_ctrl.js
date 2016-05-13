app.controller(
	'modules_ctrl', [
	'$scope'
	, 'Factory'
	, 'Services'
	, function ($scope, Factory, Services){
		// get module name for filter
		var path = $('#path').attr('class');
		var module = $('#module').attr('class');
		$scope.init = function(){
			var dataParse = {
				module: module, 
				path: path
			};
			Factory.getModule(dataParse).success(function(data){
				$scope.modules = data;
			});
		};
		$scope.init();
		
		$('.message-remove').hide();
		$scope.remove = function(params, index){
			var data = {
				code: params.code,
				module: module, 
				path: path
			};			
			Factory.remove(data).success(function(data){
				$scope.modules.splice(index, 1);
				$scope.count = $scope.count + 1;
				// alert message
				Services.alertMessage('.message-remove');	
			});
		};
		
	}
]);