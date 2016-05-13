app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			state('/type', {
				url: '/type',
				templateUrl: 'js/ng/app/vehicles/partials/vehicle_type.html',
                controller: 'vehicle_type_ctrl'
			})
			.state('/model', {
				url: '/model',
				templateUrl: 'js/ng/app/vehicles/partials/vehicle_model.html',
                controller: 'vehicle_model_ctrl'
			})
			.state('/brand', {
				url: '/brand',
				templateUrl: 'js/ng/app/vehicles/partials/vehicle_brand.html',
                controller: 'vehicle_brand_ctrl'
			})
			.state('/seat', {
				url: '/seat',
				templateUrl: 'js/ng/app/vehicles/partials/vehicle_seat.html',
                controller: 'vehicle_seat_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/type');
	}
]);
