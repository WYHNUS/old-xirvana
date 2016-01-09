'use strict';

var xirvana = angular.module("xirvanaApp", ["ui.router", "ui.calendar", "smart-table"]);

xirvana.config(function($stateProvider, $urlRouterProvider) {
	$stateProvider
		.state("main", {
			url: "/",
			title: "Xirvana",
			templateUrl: "/app/components/home/homeView.html",
			resolve: {},
			controller: "homeController"
		})
		.state("booking", {
			url: "/booking",
			title: "Xirvana Booking",
			templateUrl: "/app/components/booking/bookingView.html",
			resolve: {},
			controller: "bookingController"
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
            controller: "ojDetailController",
            onEnter: function(){
                console.log("enter oj.detail");
            }
        });

	$urlRouterProvider.otherwise("/");
});