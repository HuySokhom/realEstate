app.directive('plan',function(){
    return {
        restrict: 'EA',
        templateUrl : 'ext/ng/app/account/partials/plan.html',
        controller: function ($scope) {
            $scope.book = function () {
                alert('book');
            }
        }
    };

});