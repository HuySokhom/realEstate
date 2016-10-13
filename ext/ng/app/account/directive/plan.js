app.directive('plan',function(){
    return {
        restrict: 'EA',
        templateUrl : 'ext/ng/app/account/partials/plan.html',
        controller: function ($scope, $http, alertify) {
            $scope.currentPlan = $('#customers_plan').attr('value');
            $scope.currentPlanExpire = new Date($('#customers_expire_plan').attr('value'));
            // init plan price
            $http({
                url: 'api/PlanPrice',
                method: 'GET',
            }).success(function(data){
                console.log(data);
                $scope.planPrice = data.elements;
            });
            // init plan description
            $http({
                url: 'api/PlanText',
                method: 'GET',
            }).success(function(data){
                console.log(data);
                $scope.planDescriptions = data.elements;
            });
            $scope.customers_plan = $("#customers_plan").val();

            $scope.book = function (planNumber) {
                if($scope.currentPlan > 1){
                    $scope.upgrade(planNumber);
                    return;
                }
                $scope.disabled = true;
                var params = {plan: planNumber};
                $http({
                    url: 'api/Session/User/Plan',
                    method: 'POST',
                    data: params
                }).success(function(data){console.log(data);
                    $scope.disabled = false;
                    alertify.alert("" +
                        '<b>Successful: </b><img src="images/book.jpg" width="50px;"> ' +
                        "<br/>Please wait our assistant will contact you  soon."
                    );

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
                        '<b>Successful:</b><img src="images/upgrade.png" width="50px;">' +
                        "<br/>Please wait our assistant will contact you  soon."
                    );
                });
            };
        }
    };

});