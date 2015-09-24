'use strict';

var app = angular.module('application', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/', {
			templateUrl: 'res/views/index.html',
			controller: 'IndexController'
		}).
		when('/showOrders', {
			templateUrl: 'res/views/login.html',
			controller: 'LoginController'
		}).
		otherwise({
    		redirectTo: '/'
   		});
}]);

angular.module('application')
  .run(function($rootScope) {
    $rootScope.set_title = function(title) {
    	this.title = title;
    };
  });


var main_controller = app.controller('MainController', function($scope){
	//$scope.title = "Angular JS Platforme - Index";
});

app.controller('IndexController', function($scope, $rootScope){
	$rootScope.set_title("Angular JS - Index");
});

app.controller('LoginController', function($scope){
	// $rootScope.set_title("Angular JS - Login");
});