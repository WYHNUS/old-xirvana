'use strict';

angular.module("xirvanaApp")
	.controller("ojController", ["$scope", "$state",
		function($scope, $state) {
            $scope.practiceInfos = [];
            $scope.practiceRootURL = "/assets/Practice/";
            $scope.maxPracticeIndex = 43;
            for (var i=1; i<=$scope.maxPracticeIndex; i++) {
                var tempPractice = new Object();
                var index = (i<10) ? ("0" + i) : i;
                var practiceUrl = $scope.practiceRootURL + "practice" + index + "/";
                tempPractice.pdfUrl = practiceUrl + "practice" + index + ".pdf";
                tempPractice.id = i;
                tempPractice.name = "practice" + index;
                $scope.practiceInfos.push(tempPractice);
            }
		}]);