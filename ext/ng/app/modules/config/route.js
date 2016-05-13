app.config(['$routeProvider',
	function($routeProvider) {
		$routeProvider.
			when('/', {
				templateUrl: 'js/ng/app/modules/partials/index.html',
                controller: 'modules_ctrl'
			})
			.when('/:id', {
				templateUrl: 'js/ng/app/modules/partials/index.html',
                controller: 'modules_ctrl'
			})
			.otherwise({
				redirectTo: '/'
			});
	}
]);