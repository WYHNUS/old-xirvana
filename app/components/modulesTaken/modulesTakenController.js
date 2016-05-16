'use strict';

angular.module("xirvanaApp")
    .controller("modulesTakenController", ["$scope", "ConnectDBService",
    function($scope, ConnectDBService) {
        $scope.retrieve = function() {
            console.log("start crawling...");
            $scope.errorMsg = "";
            
            ConnectDBService.crawlNUSTakenModule($scope.user).then(function(response) {
                console.log(response.msg);
                $scope.takenModules = JSON.parse(response.msg);
                console.log($scope.takenModules);
            }, function(err) {
                $scope.errorMsg = err;
                console.log($scope.errorMsg);
            })
        } 
    }]);