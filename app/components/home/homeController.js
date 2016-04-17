'use strict';

angular.module("xirvanaApp")
	.controller("homeController", ["$scope", "$state", 
		function($scope, $state) {
			$scope.title = "XIRVANA";
            
            $scope.directBiblography = function () {
				console.log("direct to biblography state");
				$state.go("biblography");
			}
            
            $scope.directOnlineJudgement = function () {
                console.log("direct to Online Judgement state");
                $state.go("onlineJudgement");
            }
		}]);