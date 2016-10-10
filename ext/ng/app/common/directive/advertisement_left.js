app.directive('advertisementLeft',function(){
    return {
        restrict: 'EA',
        templateUrl : 'ext/ng/app/common/partials/advertisementLeft.html',
        controller: 'advertisement_left_ctrl'
    };
});

app.controller( 'advertisement_left_ctrl', [
    '$scope'
    , '$http'
    , function ( $scope, $http ) {

        $scope.init = function(params){
            params = {'location': 'left'};
            $http({
                url: 'api/Advertisement',
                method: 'GET',
                params: params
            }).success(function(data){
                $scope.advertisementLeft = data;
                console.log(data);
            });
        };
        $scope.init();

    }
]);