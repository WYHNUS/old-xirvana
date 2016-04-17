'use strict';

angular.module("xirvanaApp")
	.controller("biblographyController", ["$scope", 
    function($scope) {
        $scope.csModulesEnrolled = [{code:"CS1231", name:"Discrete Structures"},
                                    {code:"CS1101S", name:"Programming Methodology"},
                                    {code:"CS1020", name:"Data Structure and Algorithms I"},
                                    {code:"CS2010", name:"Data Structure and Algorithms II"},
                                    {code:"CS2010R", name:"Data Structure and Algorithms II"},
                                    {code:"CS2100", name:"Computer Organisation"},
                                    {code:"CS2101", name:"Effective Communication for Computing Professionals"},
                                    {code:"CS2102", name:"Database Systems"},
                                    {code:"CS2103T", name:"Software Engineering"},
                                    {code:"CS2104", name:"Programming Language Concepts"},
                                    {code:"CS2105", name:"Introduction to Computer Network"},
                                    {code:"CS2106", name:"Introduction to Operating Systems"},
                                    {code:"CS2107", name:"Introduction to Information Security"},
                                    {code:"CS3230", name:"Design and Analysis of Algorithms"},
                                    {code:"CS3241", name:"Computer Graphics"}
                                   ];
        $scope.mathModulesEnrolled = [{code:"MA1101R", name:"Linear Algebra I"},
                                     {code:"MA2101", name:"Linear Algebra II"},
                                     {code:"MA1102R", name:"Calculus"},
                                     {code:"MA1104", name:"Multivariable Calculus"},
                                     {code:"MA2108", name:"Mathematical Analysis I"},
                                     {code:"MA2213", name:"Numerical Analysis I"},
                                     {code:"MA2214", name:"Combinatorics and Graphs I"},
                                     {code:"MA3220", name:"Ordinary Differential Equations"},
                                     {code:"MA3269", name:"Mathematical Finance I"},
                                     {code:"ST1131", name:"Introduction to Statistics"},
                                     {code:"ST2131", name:"Probability"},
                                     {code:"ST3131", name:"Regression Analysis"}
                                    ];
    }]);