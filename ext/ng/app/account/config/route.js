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
				templateUrl: 'ext/ng/app/account/partials/property_post.html',
				controller: 'property_post_ctrl'
			})
			.state('/manage_property/edit/:id', {
				url: '/manage_property/edit/:id',
				templateUrl: 'ext/ng/app/account/partials/property_edit.html',
				controller: 'property_edit_ctrl'
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
			.state('/account/edit', {
				url: '/account/edit',
				templateUrl: 'ext/ng/app/account/partials/account_edit.html',
				controller: 'account_edit_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/account');
	}
]);
