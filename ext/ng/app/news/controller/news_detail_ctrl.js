app.controller(
	'news_detail_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, '$location'
	, function ($scope, Restful, $stateParams, $location){

		var url = 'api/Session/User/News/';
		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				$scope.news = data.elements[0].detail;
				$scope.title_en = data.elements[0].detail[0].title;
				$scope.title_kh = data.elements[0].detail[1].title;
				$scope.content_en = data.elements[0].detail[0].content;
				$scope.content_kh = data.elements[0].detail[1].content;
				$scope.image = data.elements[0].image;
				$scope.postDate = data.elements[0].create_date;
				$scope.createBy = data.elements[0].create_by;
				console.log(data);
			});
		};
		$scope.init();

	}
]);