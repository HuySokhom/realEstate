app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider
			.state('/manage_article', {
				url: '/manage_article',
				templateUrl: 'js/ng/app/news/partials/news.html',
				controller: 'news_ctrl'
			})
			.state('/manage_article/post', {
				url: '/manage_article/post',
				templateUrl: 'js/ng/app/news/partials/news_post.html',
				controller: 'news_post_ctrl'
			})
			.state('/manage_article/edit/:id', {
				url: '/manage_article/edit/:id',
				templateUrl: 'js/ng/app/news/partials/news_edit.html',
				controller: 'news_edit_ctrl'
			})
			.state('/type', {
				url: '/type',
				templateUrl: 'js/ng/app/news/partials/type.html',
                controller: 'type_ctrl'
			})
			.state('/type/edit:id', {
				url: '/type/edit/:id',
				templateUrl: 'js/ng/app/news/partials/type_edit.html',
				controller: 'type_edit_ctrl'
			})
			.state('/type/post', {
				url: '/type/post',
				templateUrl: 'js/ng/app/news/partials/type_post.html',
				controller: 'type_post_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);
