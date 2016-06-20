app.controller(
	'detail_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, '$sce'
	, function ($scope, Restful, $stateParams, $sce){

		var url = 'api/Agent/';
		$scope.init = function(params){
			Restful.get(url + $stateParams.id, params).success(function(data){
				$scope.agent = data.elements[0];
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