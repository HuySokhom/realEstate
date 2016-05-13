app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/image_slider', {
				url: '/image_slider',
				templateUrl: 'js/ng/app/image_slider/partials/image_slider.html',
                controller: 'image_slider_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/image_slider');
	}
]);
