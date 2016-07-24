app.controller(
    'report_customer_expire_ctrl', [
        '$scope'
        , 'Restful'
        , 'Services'
        , function ($scope, Restful, Services){
            $scope.service = new Services();
            var url = 'api/ExpirePlan/';
            $scope.init = function(){
                $scope.plans = '';
                Restful.get(url).success(function(data){
                    $scope.plans = data;
                    //console.log(data);
                });
            };
            $scope.init();

            $scope.print = function(){
                if( !$scope.plans ){
                    return $scope.service.alertMessage(
                        'Warning:','Please Filter to Print.','warning'
                    );
                }
                var divToPrint = document.getElementById("print");
                console.log(divToPrint);
                var newWin= window.open("");
                newWin.document.write('' +
                    '<html><head>' +
                    '<link href="css/print_table.css" rel="stylesheet" type="text/css">' +
                    '</head>' +
                    '<body>' + divToPrint.innerHTML + '</body>' +
                    '</html>'
                );
                newWin.print();
                newWin.close();
            };

        }
    ]);
