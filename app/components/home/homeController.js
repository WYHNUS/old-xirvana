'use strict';

angular.module("xirvanaApp")
	.controller("homeController", ["$scope", "$state", 
		function($scope, $state) {
			$scope.title = "XIRVANA";
            
            $scope.directBiblography = function () {
				console.log("direct to biblography state");
				$state.go("biblography");
			}
            
            $scope.directNUSTakenModulesCrawler = function () {
                console.log("direct to NUS taken modules crawler state");
                $state.go("takenModuleCrawler");
            }
            
            $scope.directOnlineJudgement = function () {
                console.log("direct to Online Judgement state");
                $state.go("onlineJudgement");
            }
            
            $scope.directOMPM = function () {
                console.log("direct to Owe Money Pay Money");
                $state.go("ompm");
            }
		}]);