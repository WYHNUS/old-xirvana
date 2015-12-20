'user strict';

angular.module("xirvanaApp")
	.controller("homeController", ["$scope", "$state", 
		function($scope, $state) {
			$scope.title = "XIRVANA";

            $scope.directBooking = function () {
				console.log("direct to booking state");
				$state.go("booking");
			}
            
            $scope.directWeekendApp = function () {
				console.log("direct to weekend app state");
				$state.go("app");
			}
		}]);