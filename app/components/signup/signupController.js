'use strict';

angular.module("xirvanaApp")
    .controller("signupController", ["$scope",
        function($scope) {
            $scope.signup = function() {
                console.log("submit!");
            }
        }
    ]);