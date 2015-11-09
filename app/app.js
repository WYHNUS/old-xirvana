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
		});

	$urlRouterProvider.otherwise("/");
});