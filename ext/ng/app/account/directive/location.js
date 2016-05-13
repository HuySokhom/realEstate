app.directive('locationAccount',[
	'Restful',
	function(Restful){
		return {
			restrict: 'EA',
			templateUrl : 'ext/ng/app/account/partials/location.html',
			link: function ($scope, element, $attr) {
				var urlLocation = 'api/Location';
				Restful.get(urlLocation).success(function(data){
					$scope.location = data;
				});
			}
		};
	}
]);
