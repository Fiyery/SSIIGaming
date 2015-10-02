'use strict';

var app = angular.module('application', ['ngRoute']);

angular.module('application').run(function($rootScope, NotificationService, UserService) {
    $rootScope.set_title = function(title) {
    	this.title = title;
    };
    $rootScope.remove_msg = function(id) {
    	NotificationService.remove(id);
    };
    $rootScope.is_connected = function(){
    	return UserService.is_connected();
    };
    $rootScope.get_user = function(){
    	return UserService.get_user();
    };
});

angular.module('application').run(function($rootScope, $location, NotificationService, UserService) {
    $rootScope.$on("$routeChangeStart", function (event, next, current) {
    	if (next.$$route) {
			if (UserService.is_connected() == false && next.$$route.originalPath != '/' && next.$$route.originalPath != '/register') {
	           	$location.url("/");
				NotificationService.send("You must be logged to access this page", 'warning', 'access_control');
	        } else {
	        	if (UserService.is_connected() && (next.$$route.originalPath == '/' || next.$$route.originalPath == '/register')) {
					$location.url("/consultant");
					NotificationService.send("You are already logged in", 'warning', 'access_control');
	        	}
	        }
    	}
    });
});

app.config(['$routeProvider', function($routeProvider) {
	$routeProvider
		.when('/', {
			templateUrl: 'res/views/index.html',
			controller: 'IndexController'
		})
		.when('/register', {
			templateUrl: 'res/views/register.html',
			controller: 'RegisterController'
		})
		.when('/consultant', {
			templateUrl: 'res/views/consultant.html',
			controller: 'ConsultantController'
		})
		.when('/sign-out', {
			templateUrl: 'res/views/consultant.html',
			controller: 'SignOutController'
		})
		.otherwise({
    		redirectTo: '/'
   		});
}]);

var Core = {
	'root': function(){
		var url = window.location.protocol+'://';
		url += window.location.host;
		if (window.location.host == 'localhost' || window.location.host == '127.0.0.1') {
			url += window.location.pathname;
		} else {
			url += '/';
		}
		return url;
	}, 
	'load':  function(item, type) {
		if (item == 'js') {
			var s = document.createElement("script");
			s.type = "text/javascript";
			s.src = item;
			document.getElementsByTagName("head")[0].appendChild(s) ;
		} else if (item == 'css') {
			var s = document.createElement("link") ;
			s.type = "text/css";
			s.href = item;
			s.rel = "stylesheet";
			document.getElementsByTagName("head")[0].appendChild(s) ;
		}
		

	}
}
