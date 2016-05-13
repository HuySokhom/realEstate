app.directive('installModules',function(){	
	return {
		restrict: 'EA',
		templateUrl : 'js/ng/app/modules/partials/install-module.html',
		controller: 'modules_install_ctrl'
	};
	
});