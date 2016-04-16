'use strict';

angular.module("xirvanaApp")
    .controller("signupController", ["$scope", "ConnectDBService",
        function($scope, ConnectDBService) {
            $scope.signup = function() {
                var userInfo = $("form").serializeArray().reduce(function(obj, item){
                    obj[item.name] = item.value;
                    return obj;
                }, {});
                ConnectDBService.register(userInfo);
            }
        }
    ]);