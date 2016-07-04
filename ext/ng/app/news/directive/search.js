app.directive('search',function(){
    return {
        restrict: 'EA',
        templateUrl : 'ext/ng/app/news/partials/search.html',
        controller: 'search_ctrl'
    };
});
// range with number
app.filter('rangeNumber', function () {
    return function (input, total) {
        total = parseInt(total);
        for (var i = 1; i <= total; i++) {
            input.push(i);
        }
        return input;
    };
});

app.controller( 'search_ctrl', [
    '$scope'
    , '$http'
    , function ( $scope, $http ) {

        $scope.init = function(params){
            $http({
                url: 'api/Location',
                method: 'GET',
                params: params
            }).success(function(data){
                $scope.locations = data;
            });
            $http({
                url: 'api/Category',
                method: 'GET',
                params: params
            }).success(function(data){
                $scope.categories = data;
            });
            $http({
                url: 'api/ProductFeatured',
                method: 'GET',
                params: params
            }).success(function(data){
                $scope.products = data;
            });
        };
        $scope.init();
    }
]);