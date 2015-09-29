app.controller('IndexController', function($scope, $rootScope, NotificationService, UserService){
	$rootScope.set_title("Angular JS - Index");

	if (UserService.is_connected()) {
		window.location = '#/consultant';
	}

	// NotificationService.send("Welcome on AngularJS Application !!", 'info', 'welcome_msg1');
	// NotificationService.send("Welcome on AngularJS Application !!", 'warning', 'welcome_msg2');
	// NotificationService.send("Welcome on AngularJS Application !!", 'error', 'welcome_msg3');
	// NotificationService.send("Welcome on AngularJS Application !!", 'success', 'welcome_msg4');

	// Style form
	var default_style = {'border' : '1px solid #39A9CB'};
	var error_style = {'border' : '1px solid #FB9191'};
	$scope.login_style = $scope.pass_style = default_style;

	// Form submit handler 
	$scope.submit = function(){
		// Login
		if (!$scope.login || $scope.login.length < 4) {
			$scope.login_style = error_style;
			NotificationService.send('Login must be 4 caracters or more', 'error', 'login_error');
			return false;
		} else {
			$scope.login_style = default_style;
			NotificationService.remove('login_error');
		}

		// Password
		if (!$scope.pass || $scope.pass.length < 6) {
			$scope.pass_style = error_style;
			NotificationService.send('Password must be 6 caracters or more', 'error', 'pass_error');
			return false;
		} else {
			$scope.pass_style = default_style;
			NotificationService.remove('pass_error');
		}

		// Connection
		UserService.sign_in($scope.login, $scope.pass).then(function(){		
			if (UserService.is_connected()) {
				var user = UserService.get_user();
				NotificationService.send("Welcome "+user.name, 'success', 'login_state');
				NotificationService.remove('access_control');
				window.location = '#/consultant';
			} else {
				NotificationService.send("Login fail : name or password is wrong", 'error', 'login_state');
			}
		});
		return true;
	}
});