app.controller(
'slider_ctrl', [
    '$scope'
    , 'Restful'
    , function ($scope, Restful){
        var url = 'api/Slider';
        $scope.initImageSlider = function(params){
            Restful.get(url, params).success(function(data){
                $scope.imageSlider = data;
            });
        };


    }
]);