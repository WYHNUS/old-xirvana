"user strict";

angular.module("xirvanaApp")
	.service("ConnectDBService", ["$http", "$q", function($http, $q) {
		function booking(cmd, registrationInfo) {
			console.log("registration info : ");
			console.log(registrationInfo);

			// submit form to back-end php file
			var deferred = $q.defer();
            var params = new FormData();
            params.append("command", cmd);
            params.append("object", JSON.stringify(registrationInfo));
            $http.post("app/backend/connectBookingDB.php", params, {
              	transformRequest: angular.identity,
              	headers: {"Content-Type": undefined}
            }).success(function(data, status, headers, config) {
            	console.log(data);
              	if (data == null) {
					deferred.reject("data.error");
              	} else {
                	if (data.status.toLowerCase() == "success") {
						deferred.resolve(data);
	                } else {
	                    deferred.reject(data.error);
	                }
	            }	
            }).error(function(data, status, headers, config) {
				deferred.reject(data.error);
            });
            return deferred.promise;
		}

		return {
			booking : booking
		}
	}]);