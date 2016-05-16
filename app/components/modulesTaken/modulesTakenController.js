'use strict';

angular.module("xirvanaApp")
    .controller("modulesTakenController", ["$scope", "ConnectDBService",
    function($scope, ConnectDBService) {
        $scope.retrieve = function() {
            $scope.errorMsg = "";
            
            ConnectDBService.crawlNUSTakenModule($scope.user).then(function(response) {
                var takenModules = JSON.parse(response.msg);
                console.log(takenModules);
            }, function(err) {
                $scope.errorMsg = err;
                console.log($scope.errorMsg);
            })
        } 
    }]);