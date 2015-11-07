'user strict';

angular.module("xirvanaApp")
	.controller("bookingController", ["$scope", "ConnectDBService",
	 function($scope, ConnectDBService) {
		$scope.title = "XIRVANA Booking";

		$scope.submitBooking = function(user) {
			ConnectDBService.addBooking(user);
		}
	}]);