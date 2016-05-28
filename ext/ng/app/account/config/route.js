app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/managePost', {
				url: '/managePost',
				templateUrl: 'ext/ng/app/account/partials/manage.html',
                controller: 'manage_ctrl'
			})
			.state('/account', {
				url: '/account',
				templateUrl: 'ext/ng/app/account/partials/account.html',
                controller: 'account_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/managePost');
	}
]);
