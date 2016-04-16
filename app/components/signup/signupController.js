'use strict';

angular.module("xirvanaApp")
    .controller("signupController", ["$scope", "ConnectDBService",
        function($scope, ConnectDBService) {
            $scope.errorMsg = "";
            $scope.signup = function() {
                $scope.errorMsg = "";
                
                var userInfo = $("form").serializeArray().reduce(function(obj, item){
                    obj[item.name] = item.value;
                    return obj;
                }, {});
                
                ConnectDBService.register(userInfo).then(function(response) {
                    console.log(response);
                }, function(err) {
                    $scope.errorMsg = err;
                    console.log($scope.errorMsg);
                });
            }
        }
    ]);