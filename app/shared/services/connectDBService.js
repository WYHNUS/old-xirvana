"use strict";

/*
    service support function to:
    1. register a new user
    2. check if a user is registered
    3. crawl taken modules if nus login information is provided
    4. pass data for owe money pay money app
*/

angular.module("xirvanaApp")
	.service("ConnectDBService", ["$http", "$q", function($http, $q) {
        function connect(url, params) {
			// submit form to back-end php file
            var deferred = $q.defer();
            $http.post(url, params, {
              	transformRequest: angular.identity,
              	headers: {"Content-Type": undefined}
            }).success(function(data, status, headers, config) {
              	if (data == null) {
					deferred.reject("data.error");
              	} else {
                    console.log(data);
                	if (data.status.toLowerCase() == "success" || data.status.toLowerCase() == "ok") {
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
        
		function register(userInfo) {
            var url = "app/backend/connectDB.php";
            var params = new FormData();
            params.append("command", "register");
            params.append("object", JSON.stringify(userInfo));
            return connect(url, params);
		}
        
        function login(userInfo) {
            var url = "app/backend/connectDB.php";
            var params = new FormData();
            params.append("command", "login");
            params.append("object", JSON.stringify(userInfo));
            return connect(url, params);
		}
        
        function crawlNUSTakenModule(userInfo) {
            var url = "app/backend/getNUSTakenModules.php";
            var params = new FormData();
            params.append("object", JSON.stringify(userInfo));
            return connect(url, params);
        }
        
        function submitTransaction(userInfo) {
            var url = "app/backend/oweMoneyPayMoney.php";
            var params = new FormData();
            params.append("object", JSON.stringify(userInfo));
            return connect(url, params);
        }

		return {
			register : register,
            login : login,
            crawlNUSTakenModule: crawlNUSTakenModule,
            submitTransaction : submitTransaction
		}
	}]);