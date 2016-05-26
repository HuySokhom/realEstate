app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/', {
				url: '/',
				templateUrl: 'js/ng/app/image_slider/partials/image_slider.html',
                controller: 'image_slider_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/');
	}
]);
