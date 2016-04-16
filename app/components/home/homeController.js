'user strict';

angular.module("xirvanaApp")
	.controller("homeController", ["$scope", "$state", 
		function($scope, $state) {
			$scope.title = "XIRVANA";
            
            $scope.directWeekendApp = function () {
				console.log("direct to weekend app state");
				$state.go("app");
			}
            
            $scope.directOnlineJudgement = function () {
                console.log("direct to Online Judgement state");
                $state.go("onlineJudgement");
            }
		}]);