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
        controller: ["$scope", "$state", function($scope, $state) {
            // behaviour goes here :)
            $scope.directMainPage = function() {
                 $state.go("main");
            }
            
            $scope.directSignUp = function() {
                console.log("direct sign up");
                $state.go("signup");
            }
            
            $scope.login = function() {
                
            }
        }]
    }
});

module.directive("myPdfDisplay", function() {
   return {
       restrict: "A",
       scope: {pdfUrl: "@url"},
       link: function(scope, element, attributes){
           PDFJS.getDocument(attributes.url).then(function(pdf) {
                // Fetch the page.
                for (var i=1; i<=pdf.numPages; i++) {
                    pdf.getPage(i).then(function (page) {
                        var scale = 1.5;
                        var viewport = page.getViewport(scale);

                        // Prepare canvas using PDF page dimensions.
                        var canvas = document.createElement("canvas");
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        // Render PDF page into canvas context.
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext);
                        
                        document.getElementById("question-display").appendChild(canvas);
                    });
                }
           });
       },
       templateUrl: "/app/shared/directives/pdfDisplay.html"
   } 
});