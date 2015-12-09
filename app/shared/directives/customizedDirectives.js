var module = angular.module("xirvanaApp");

module.directive("myFooter", function() {
    return {
        restrict: "A",
        templateUrl: "/app/shared/directives/footer.html",
        controller: ["$scope", function($scope) {
            // behaviour goes here :)
        }]
    }
});

module.directive("myHeader", function() {
    return {
        restirct: "A",
        scope: {user: "="},
        templateUrl: "/app/shared/directives/header.html",
        controller: ["$scope", function($scope) {
            // behaviour goes here :)
        }]
    }
});