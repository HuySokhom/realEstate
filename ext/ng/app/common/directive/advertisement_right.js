app.directive('advertisementRight',function(){
    return {
        restrict: 'EA',
        templateUrl : 'ext/ng/app/common/partials/advertisementRight.html',
        controller: 'advertisement_right_ctrl'
    };
});

app.controller( 'advertisement_right_ctrl', [
    '$scope'
    , '$http'
    , function ( $scope, $http ) {

        $scope.init = function(params){
            params = {'location': 'right'};
            $http({
                url: 'api/Advertisement',
                method: 'GET',
                params: params
            }).success(function(data){
                $scope.advertisementRight = data;
                console.log($scope.advertisementRight);
            });
        };
        $scope.init();

    }
]);