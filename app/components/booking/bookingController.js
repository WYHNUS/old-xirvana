'user strict';

angular.module("xirvanaApp")
	.controller("bookingController", ["$scope", "ConnectDBService",
	 function($scope, ConnectDBService) {
		$scope.title = "XIRVANA Booking";
		$scope.response = "";

        $scope.eventSources = [];
        /* config object */
        $scope.uiConfig = {
            calendar:{
                height: 450,
                timezone: 'local',
                editable: true,
                header:{
                  left: 'month agendaWeek agendaDay',
                  center: 'title',
                  right: 'today prev,next'
                },
                dayClick: $scope.alertEventOnClick,
                eventDrop: $scope.alertOnDrop,
                eventResize: $scope.alertOnResize
            }
        };

		$scope.submitBooking = function(user) {
			ConnectDBService.booking("insert", user)
				.then(function(response) {
					$scope.response = "registration successful";
					console.log(response);
				}, function(response) {
					$scope.response = ("registration failed : " + response);
					console.log(response);
				});
		}
	}]);