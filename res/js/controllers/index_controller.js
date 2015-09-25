app.controller('IndexController', function($scope, $rootScope, NotificationService){
	$rootScope.set_title("Angular JS - Index");

	NotificationService.send("Welcome on AngularJS Application !!", 'info', 'welcome_msg1');
	NotificationService.send("Welcome on AngularJS Application !!", 'warning', 'welcome_msg2');
	NotificationService.send("Welcome on AngularJS Application !!", 'error', 'welcome_msg3');
	NotificationService.send("Welcome on AngularJS Application !!", 'success', 'welcome_msg4');

	// Style form
	$scope.login_style = {
		'border' : '1px solid #39A9CB'
	};
	$scope.pass_style = {
		'border' : '1px solid #39A9CB'	
	};

	// Form submit handler 
	$scope.submit = function(){
		if (!$scope.login || $scope.login.length < 6) {
			$scope.login_style = {
				'border' : '1px solid #FB9191'
			};
			NotificationService.send('Login must be 6 caracters or more', 'error', 'login_error');
			return false;
		} else {
			$scope.login_style = {
				'border' : '1px solid #39A9CB'
			};
			NotificationService.remove('login_error');
		}
		if (!$scope.pass || $scope.pass.length < 6) {
			$scope.pass_style = {
				'border' : '1px solid #FB9191'
			};
			NotificationService.send('Password must be 6 caracters or more', 'error', 'pass_error');
			return false;
		} else {
			$scope.pass_style = {
				'border' : '1px solid #39A9CB'
			};
			NotificationService.remove('pass_error');
		}
		return true;
	}
});