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
        });

	$urlRouterProvider.otherwise("/");
});