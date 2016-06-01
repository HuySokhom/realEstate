app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/', {
				url: '/',
				templateUrl: 'ext/ng/app/news/partials/news.html',
				controller: 'news_ctrl'
			})
			.state('/:id', {
				url: '/:id',
				templateUrl: 'ext/ng/app/news/partials/news_detail.html',
				controller: 'news_detail_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);
