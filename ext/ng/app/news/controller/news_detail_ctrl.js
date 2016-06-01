app.controller(
	'news_detail_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, 'Services'
	, '$location'
	, function ($scope, Restful, $stateParams, Services, $location){

		var url = 'api/Session/User/News/';
		$scope.service = new Services();

		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				$scope.news = data.elements[0].detail;
				$scope.title_en = data.elements[0].detail[0].title;
				$scope.title_kh = data.elements[0].detail[1].title;
				$scope.content_en = data.elements[0].detail[0].content;
				$scope.content_kh = data.elements[0].detail[1].content;
				$scope.image = data.elements[0].image;
				$scope.image_thumbnail = data.elements[0].image_thumbnail;
			});
		};
		$scope.init();

	}
]);