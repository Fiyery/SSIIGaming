'use strict';

var app = angular.module('application', ['ngRoute']);

angular.module('application')
  .run(function($rootScope) {
    $rootScope.set_title = function(title) {
    	this.title = title;
    };
  });

app.config(['$routeProvider', function($routeProvider) {
	$routeProvider.
		when('/', {
			templateUrl: 'res/views/index.html',
			controller: 'IndexController'
		}).
		when('/user', {
			templateUrl: 'res/views/user.html',
			controller: 'UserController'
		}).
		otherwise({
    		redirectTo: '/'
   		});
}]);


var main_controller = app.controller('MainController', function($scope){
	
});

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
