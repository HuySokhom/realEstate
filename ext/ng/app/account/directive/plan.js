app.directive('plan',function(){
    return {
        restrict: 'EA',
        templateUrl : 'ext/ng/app/account/partials/plan.html',
        controller: function ($scope, $http, alertify) {

            $scope.customers_plan = $("#customers_plan").val();

            $scope.book = function (planNumber) {
                $scope.disabled = true;
                var params = {plan: planNumber};
                $http({
                    url: 'api/Session/User/Plan',
                    method: 'POST',
                    data: params
                }).success(function(data){console.log(data);
                    $scope.disabled = false;
                    if(data.id != "success"){
                        alertify.alert("" +
                            '<b>Congratulation: </b><img src="images/book.jpg" width="50px;"> Your book has successful. ' +
                            "<br/>Please wait our assistant will contact you  soon."
                        );
                    }else{
                        alertify.alert("" +
                            '<b>Successful: </b><img src="images/book.jpg" width="50px;"> You already book. ' +
                            "<br/>Please wait our assistant will contact you  soon."
                        );
                    }
                });
            };

            $scope.upgrade = function (planNumber) {
                $scope.disabled = true;
                var params = {plan: planNumber};
                $http({
                    url: 'api/Session/User/PlanUpgrade',
                    method: 'POST',
                    data: params
                }).success(function(data){
                    console.log(data);
                    $scope.disabled = false;
                    alertify.alert("" +
                        '<b>Congratulation:</b><img src="images/upgrade.png" width="50px;">  Your upgrade has successful. ' +
                        "<br/>Please wait our assistant will contact you  soon."
                    );
                });
            };
        }
    };

});