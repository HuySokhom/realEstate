app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider
			.state('/', {
				url: '/',
				templateUrl: 'js/ng/app/index/partials/index.html',
				controller: 'index_ctrl'
			})
			.state('/news', {
				url: '/news',
				templateUrl: 'js/ng/app/news/partials/news.html',
				controller: 'news_ctrl'
			})
			.state('/news/post', {
				url: '/news/post',
				templateUrl: 'js/ng/app/news/partials/news_post.html',
				controller: 'news_post_ctrl'
			})
			.state('/news/edit/:id', {
				url: '/news/edit/:id',
				templateUrl: 'js/ng/app/news/partials/news_edit.html',
				controller: 'news_edit_ctrl'
			})
			.state('/news_type', {
				url: '/news_type',
				templateUrl: 'js/ng/app/news/partials/type.html',
                controller: 'type_ctrl'
			})
			.state('/news_type/edit:id', {
				url: '/news_type/edit/:id',
				templateUrl: 'js/ng/app/news/partials/type_edit.html',
				controller: 'type_edit_ctrl'
			})
			.state('/news_type/post', {
				url: '/news_type/post',
				templateUrl: 'js/ng/app/news/partials/type_post.html',
				controller: 'type_post_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);
