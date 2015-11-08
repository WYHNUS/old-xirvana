'user strict';

angular.module("xirvanaApp")
	.controller("bookingController", ["$scope", "ConnectDBService",
	 function($scope, ConnectDBService) {
		$scope.title = "XIRVANA Booking";

		$scope.submitBooking = function(user) {
			ConnectDBService.booking("insert", user)
				.then(function(response) {
					console.log("booking successful");
					console.log(response);
				});
		}
	}]);