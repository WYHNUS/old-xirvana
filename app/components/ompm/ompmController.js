"use restrict"

angular.module("xirvanaApp")
    .controller("ompmController", ["$scope", "ConnectDBService",
    function($scope, ConnectDBService) {
        $scope.data = {
            homies : [
                {name:"彦皓", id:"yanhao", email:"yanhao@u.nus.edu"},
                {name:"鹤阳", id:"heyang", email:"wuheyang0617@gmail.com"}
            ],
            name : null,
            creditor : null,
            debtors : [false, false, false, false, false],
            amount : 0,
            is_share : true
        };
        
        $scope.calMoney = function() {
            console.log($scope.data);
            
            var debtors = [];
            var is_select = false;
            for (var i=0; i<$scope.data.debtors.length; i++) {
                if ($scope.data.debtors[i]) {
                    is_select = true;
                    debtors.push($scope.data.homies[i].email);
                }
            }
            // check if at least one debtor is selected
            if (!is_select) {
                alert("Please select at least one debtor!");
            }
            
            // process data
            var processed_data = {
                name : $scope.data.name,
                creditor : $scope.data.creditor,
                debtors : []
            };
            if ($scope.data.is_share) {
                var amount = 1.0 * $scope.data.amount / debtors.length;
                for (var i=0; i<debtors.length; i++) {
                    var debtor = {
                        email : debtors[i],
                        amount : "" + amount
                    };
                    processed_data.debtors.push(debtor);
                }
            }
            console.log(processed_data);
            
            // pass data to php
            ConnectDBService.submitTransaction(processed_data).then(function(response) {
                console.log(response);
            }, function(err) {
                console.log(err);
                $scope.errorMsg = err;
                console.log($scope.errorMsg);
            });
        }
    }]);