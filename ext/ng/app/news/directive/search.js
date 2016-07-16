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
    , '$window'
    , function ( $scope, $http, $window ) {

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

        $scope.search = function(){
            var cId = '';
            var location = '';
            if($scope.categories_id){
                cId = $scope.categories_id.categories_id;
            }
            if($scope.location){
                location = $scope.location.id;
            }
            var link = 
            "advanced_search_result.php?categories_id=" + cId + 
            "&location="+ location +
            "&type=" + $scope.type + 
            "&bfrom=" + $scope.bedFrom +
            "&bto=" + $scope.bedTo +
            "&pfrom=" + $scope.minPrice +
            "&pto=" + $scope.maxPrice;
            return $window.location.href = link;
        };

    }
]);