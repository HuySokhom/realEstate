app.controller(
	'news_detail_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, '$sce'
	, function ($scope, Restful, $stateParams, $sce){

		var url = 'api/News/';
		$scope.init = function(params){
			Restful.get(url + $stateParams.newsId, params).success(function(data){
				$scope.news = data;
				if(data.count > 0) {
					$scope.title_en = data.elements[0].detail[0].title;
					$scope.title_kh = data.elements[0].detail[1].title;
					$scope.content_en = $sce.trustAsHtml(data.elements[0].detail[0].content);
					$scope.content_kh = $sce.trustAsHtml(data.elements[0].detail[1].content);
					$scope.image = data.elements[0].image;
					$scope.postDate = data.elements[0].create_date;
					$scope.createBy = data.elements[0].create_by;
					//console.log(data);
				}
			});
			// init other post news
			var params = {
				type_id: $stateParams.typeId,
				news_id: $stateParams.newsId
			};
			Restful.get('api/NewsOther/', params ).success(function(data){
				$scope.newsOther = data;
				//console.log(data);
			});
		};
		$scope.init();
	}
]);