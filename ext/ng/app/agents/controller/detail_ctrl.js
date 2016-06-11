app.controller(
	'detail_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, '$sce'
	, function ($scope, Restful, $stateParams, $sce){

		var url = 'api/Agent/';
		$scope.init = function(params){
			Restful.get(url + $stateParams.newsId, params).success(function(data){
				$scope.news = data;
				if(data.count > 0) {

					$scope.createBy = data.elements[0].create_by;
					console.log(data);
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