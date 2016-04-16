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
        .state("app", {
			url: "/app",
			title: "Xirvana Weekend App",
			templateUrl: "/app/components/app/appView.html",
			resolve: {},
			controller: "appController"
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