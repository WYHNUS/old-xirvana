'use strict';

angular.module("xirvanaApp")
    .controller("modulesTakenController", ["$scope", "ConnectDBService",
    function($scope, ConnectDBService) {
        $scope.isRetrieving = false;
        
        $scope.retrieve = function() {
            console.log("start crawling...");
            $scope.errorMsg = "";
            
            if (!$scope.isRetrieving) {
                $scope.isRetrieving = true;
                ConnectDBService.crawlNUSTakenModule($scope.user).then(function(response) {
                    $scope.takenModules = JSON.parse(response.msg);
                    console.log($scope.takenModules);
                    $scope.isRetrieving = false;
                }, function(err) {
                    $scope.errorMsg = err;
                    console.log($scope.errorMsg);
                    $scope.isRetrieving = false;
                });
            } else {
                $scope.errorMsg = "We are trying our best to retrive the data, please wait a moment. :)";
            }
        } 
    }]);