'use strict';

angular.module("xirvanaApp")
    .controller("ojDetailController", ["$scope", "$stateParams", "Upload",
        function($scope, $stateParams, Upload) {
            $scope.practice = $scope.practiceInfos[$stateParams.id - 1]; 
            console.log($scope.practice); 
            
            $scope.submit = function() {
                console.log($scope.file);
                if ($scope.file) {
                    $scope.upload($scope.file);
                }
            }
            
            $scope.upload = function(file) {
                Upload.upload({
                    url: "app/backend/onlineJudgementBackend.php",
                    data: {file: file,
                          practiceName: $scope.practice.name}
                }).then(function(response) {
                    console.log(response);
                    if (response.data.status == "ok") {
                        console.log("upload successful");
                        $scope.displayFeedback(response.data.message);
                    } else {
                        console.log("upload failed : " + response.data.message);
                        $scope.displayFeedback(response.data.message);
                    }
                }, function(response) {
                    console.log("upload error");
                    console.log(response);
                    $scope.displayFeedback(response.data.message);
                });
            }
            
            $scope.displayFeedback = function(msg) {
                $scope.ojfeedback = msg;
                $scope.file = null;
            }
        }]);