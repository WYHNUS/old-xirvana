'user strict';

angular.module("xirvanaApp")
	.controller("bookingController", ["$scope", "ConnectDBService",
	 function($scope, ConnectDBService) {
		$scope.title = "XIRVANA Booking";
		$scope.response = "";

		$scope.submitBooking = function(user) {
			ConnectDBService.booking("insert", user)
				.then(function(response) {
					$scope.response = "booking successful";
					console.log(response);
				}, function(response) {
					$scope.response = ("booking failed : " + response);
					console.log(response);
				});
		}
	}]);