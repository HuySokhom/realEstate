app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/manage_property', {
				url: '/manage_property',
				templateUrl: 'ext/ng/app/account/partials/property.html',
                controller: 'property_ctrl'
			})
			.state('/manage_property/post', {
				url: '/manage_property/post',
				templateUrl: 'ext/ng/app/account/partials/add_property.html',
				controller: 'add_property_ctrl'
			})
			.state('/manage_property/edit/:id', {
				url: '/manage_property/edit/:id',
				templateUrl: 'ext/ng/app/account/partials/edit_property.html',
				controller: 'edit_property_ctrl'
			})
			.state('/manage_news', {
				url: '/manage_news',
				templateUrl: 'ext/ng/app/account/partials/news.html',
				controller: 'news_ctrl'
			})
			.state('/manage_news/post', {
				url: '/manage_news/post',
				templateUrl: 'ext/ng/app/account/partials/news_post.html',
				controller: 'news_post_ctrl'
			})
			.state('/manage_news/edit/:id', {
				url: '/manage_news/edit/:id',
				templateUrl: 'ext/ng/app/account/partials/news_edit.html',
				controller: 'news_edit_ctrl'
			})
			.state('/account', {
				url: '/account',
				templateUrl: 'ext/ng/app/account/partials/account.html',
                controller: 'account_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/account');
	}
]);
