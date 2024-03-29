'use strict';

angular.module("xirvanaApp")
    .controller("signupController", ["$scope", "$window", "ConnectDBService",
        function($scope, $window, ConnectDBService) {
            $scope.errorMsg = "";
            $scope.signup = function() {
                $scope.errorMsg = "";
                
                var userInfo = $("#signup-form").serializeArray().reduce(function(obj, item){
                    obj[item.name] = item.value;
                    return obj;
                }, {});
                
                ConnectDBService.register(userInfo).then(function(response) {
                    console.log(response);
                    $window.history.back();
                }, function(err) {
                    $scope.errorMsg = err;
                    console.log($scope.errorMsg);
                });
            }
        }
    ]);