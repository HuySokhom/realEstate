app.directive('plan',function(){
    return {
        restrict: 'EA',
        templateUrl : 'ext/ng/app/account/partials/plan.html',
        controller: function ($scope, $http, alertify) {
            $scope.book = function (planNumber) {
                $scope.disabled = true;
                var params = {plan: planNumber};
                $http({
                    url: 'api/Session/User/Plan',
                    method: 'POST',
                    data: params
                }).success(function(data){
                    $scope.disabled = false;
                    alertify.alert("" +
                        "<b>Congratulation:</b> your book has successful. " +
                        "<br/>Please wait our assistant will contact you  soon."
                    );
                });
            }
        }
    };

});