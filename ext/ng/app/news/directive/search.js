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
        $scope.language_id = $("#language_id").val();
        if($scope.language_id == 1){
            $scope.locationText = 'Location';
            $scope.category = 'All Categories';
            $scope.kind_of = 'Type';
            $scope.bedRoomFrom = 'Bed From';
            $scope.bedRoomTo = 'Bed To';
            $scope.maxProPrice = 'Max Price';
            $scope.minProPrice = 'Min Price';
            $scope.property = 'property';
            $scope.searchText = 'search';
            $scope.featured = 'Featured';
        }else{
            $scope.locationText = 'តំបន់';
            $scope.category = 'ប្រភេទទាំងអស់';
            $scope.kind_of = 'ប្រភេទ';
            $scope.bedRoomFrom = 'គ្រែចាប់ពីរ';
            $scope.bedRoomTo = 'ទៅ';
            $scope.maxProPrice = 'ទៅ';
            $scope.minProPrice = 'តំម្លៃចាប់ពីរ';
            $scope.property = 'អចលនទ្រព្យ';
            $scope.searchText = 'ស្វែងរក';
            $scope.featured = 'លក្ខណៈពិសេសជាងគេ';
        }
        $scope.init = function(params){
            $http({
                url: 'api/SearchLocation',
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
            var type = '';
            var bedFrom = '';
            var bedTo = '';
            var minPrice = '';
            var maxPrice = '';
            if($scope.categories_id){
                cId = $scope.categories_id.categories_id;
            }
            if($scope.location){
                location = $scope.location.id;
            }
            if($scope.type){
                type = $scope.type;
            }
            if($scope.bedFrom){
                bedFrom = $scope.bedFrom;
            }
            if($scope.bedTo){
                bedTo = $scope.bedTo;
            }
            if($scope.minPrice){
                minPrice = $scope.minPrice;
            }
            if($scope.maxPrice){
                maxPrice = $scope.maxPrice;
            }
            var link = 
            "advanced_search_result.php?categories_id=" + cId + 
            "&location="+ location +
            "&type=" + type +
            "&bfrom=" + bedFrom +
            "&bto=" + bedTo +
            "&pfrom=" + minPrice +
            "&pto=" + maxPrice;
            return $window.location.href = link;
        };

    }
]);