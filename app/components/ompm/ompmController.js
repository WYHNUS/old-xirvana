"use restrict"

angular.module("xirvanaApp")
    .controller("ompmController", ["$scope", "ConnectDBService",
    function($scope, ConnectDBService) {
        $scope.calMoney = function() {
            console.log($scope.user);
        }
    }]);