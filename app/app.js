'use strict';

var xirvana = angular.module("xirvanaApp", ["ui.router", "ngFileUpload"]);

xirvana.config(function($stateProvider, $urlRouterProvider) {
	$stateProvider
		.state("main", {
			url: "/",
			title: "Xirvana",
			templateUrl: "/app/components/home/homeView.html",
			resolve: {},
			controller: "homeController"
		})
        .state("signup", {
			url: "/signup",
			title: "Xirvana Signup",
			templateUrl: "/app/components/signup/signup.html",
			resolve: {},
			controller: "signupController"
		})
        .state("biblography", {
			url: "/biblography",
			title: "Xirvana Author",
			templateUrl: "/app/components/biblography/biblographyView.html",
			resolve: {},
			controller: "biblographyController"
		})
        .state("takenModuleCrawler", {
            url: "/nusTakenModules",
            title: "NUS taken modules crawler",
            templateUrl: "/app/components/modulesTaken/modulesTakenView.html",
            resolve: {},
            controller: "modulesTakenController"
        })
        .state("onlineJudgement", {
            url: "/speciallyMadeForHeYang",
            title: "Xirvana Online Judgement",
            templateUrl: "/app/components/onlineJudgement/ojView.html",
			resolve: {},
			controller: "ojController"
        })
        .state("onlineJudgement.detail", {
            url: "/:id",
            templateUrl: "/app/components/onlineJudgement/oj.detailView.html",
            resolve: {},
            controller: "ojDetailController"
        })
        .state("ompm", {
            url: "/own_money_pay_money",
            templateUrl: "/app/components/ompm/ompmView.html",
            resolve: {},
            controller: "ompmController"
        });

	$urlRouterProvider.otherwise("/");
});