app.config([
	'$stateProvider',
	'$urlRouterProvider',
	'$locationProvider',
	function($stateProvider, $urlRouterProvider, $locationProvider) {
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
			.state('/slider', {
				url: '/slider',
				templateUrl: 'js/ng/app/image_slider/partials/index.html',
				controller: 'image_slider_ctrl'
			})
			.state('/user', {
				url: '/user',
				templateUrl: 'js/ng/app/user/partials/index.html',
				controller: 'user_ctrl'
			})
			.state('/user/edit/:id', {
				url: '/user/edit/:id',
				templateUrl: 'js/ng/app/user/partials/user_edit.html',
				controller: 'user_edit_ctrl'
			})
			.state('/location', {
				url: '/location',
				templateUrl: 'js/ng/app/location/partials/location.html',
				controller: 'location_ctrl'
			})
			.state('/district', {
				url: '/district',
				templateUrl: 'js/ng/app/location/partials/district.html',
				controller: 'district_ctrl'
			})
			.state('/village', {
				url: '/village',
				templateUrl: 'js/ng/app/location/partials/village.html',
				controller: 'village_ctrl'
			})
			.state('/category', {
				url: '/category',
				templateUrl: 'js/ng/app/category/partials/index.html',
				controller: 'category_ctrl'
			})
			.state('/product', {
				url: '/product',
				templateUrl: 'js/ng/app/product/partials/index.html',
				controller: 'product_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
		// use the HTML5 History API to remove # url
		// $locationProvider.html5Mode(true);
	}
]);
