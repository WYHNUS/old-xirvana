"user strict";

angular.module("xirvanaApp")
	.service("ConnectDBService", ["$http", "$q", function($http, $q) {
		function addBooking(bookingInfo) {
			console.log("bookingInfo : ");
			console.log(bookingInfo);

			// submit form to back-end php file
			
		}

		return {
			addBooking : addBooking
		}
	}]);