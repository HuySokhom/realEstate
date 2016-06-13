app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/', {
				url: '/',
				templateUrl: 'ext/ng/app/agents/partials/index.html',
				controller: 'agent_ctrl'
			})
			.state('/:id', {
				url: '/:id',
				templateUrl: 'ext/ng/app/agents/partials/detail.html',
				controller: 'detail_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);
