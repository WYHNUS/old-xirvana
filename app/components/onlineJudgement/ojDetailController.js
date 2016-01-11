'user strict';

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
                    if (response.status == 200) {
                        console.log("upload successful");
                    } else {
                        console.log("upload failed : " + response.message);
                    }
                }, function(response) {
                    console.log("upload error");
                }, function(e) {
                    var progressPercent = parseInt(100.0 * e.loaded / e.total);
                    console.log("progress: " + progressPercent + "%");
                });
            }
        }]);