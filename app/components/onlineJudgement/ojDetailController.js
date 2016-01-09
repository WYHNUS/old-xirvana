'user strict';

angular.module("xirvanaApp")
    .controller("ojDetailController", ["$scope", "$stateParams",
        function($scope, $stateParams) {
            $scope.practice = $scope.practiceInfos[$stateParams.id - 1]; 
            console.log($scope.practice); 
        }]);