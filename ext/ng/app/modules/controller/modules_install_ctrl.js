app.controller(
	'modules_install_ctrl', [
	'$scope'
	, 'Factory'
	, 'Services'
	, '$location'
	, function ($scope, Factory, Services, $location){
		
		var path = $('#path').attr('class');
		var module = $('#module').attr('class');
		$scope.install = function(header){
			$scope.header = header;
			var dataParse = {
				module: module, 
				path: path,
				module_directory: $('#module_directory').attr('class')
			};
			Factory.get(dataParse).success(function(data){
				$scope.modules_install = data;
				$scope.count = data.length;
			});
		};
		$scope.install();
		$('.message-install').hide();
		$scope.row = null;
		$scope.installModule = function(params, $index){
			$scope.row = $index;
			var data = {
				code: params.code,
				path: path,
				module: module
			};
			Factory.insert(data).success(function(data){
				$scope.modules_install.splice($index, 1);
				$scope.count = $scope.count - 1;
				$scope.init();
				// alert message
				Services.alertMessage('.message-install');
				$scope.row = null;
			});
			
		};
		
	}
]);