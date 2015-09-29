app.controller('RegisterController', function($scope, $rootScope, $http, NotificationService, UserService){
	$rootScope.set_title("Angular JS - Register");

	// Style form
	var default_style = {'border' : '1px solid #39A9CB'};
	var error_style = {'border' : '1px solid #FB9191'};
	$scope.login_style = $scope.mail_style = $scope.pass1_style = $scope.pass2_style = default_style;
		
	// Form submit handler 
	$scope.submit = function(){
		window.location = '\#\\';
		// Login
		if (!$scope.login || !$scope.login.match(/^([\w]{4,})$/)) {
			$scope.login_style = error_style;
			NotificationService.send('Login must be at least 4 caracters (letter, number or "_")', 'error', 'login_error');
			return false;
		} else {
			$scope.login_style = default_style;
			NotificationService.remove('login_error');
		}

		// Mail
		if (!$scope.mail || !$scope.mail.match(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/)) {
			$scope.mail_style = error_style;
			NotificationService.send('Mail is not valid', 'error', 'mail_error');
			return false;
		} else {
			$scope.mail_style = default_style;
			NotificationService.remove('mail_error');
		}

		// Password1
		if (!$scope.pass1 || !$scope.pass1.match(/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*){6,}$/)) {
			$scope.pass1_style = error_style;
			NotificationService.send('Password must be at least 6 caracters with 1 lowercase letter, 1 uppercase letter and 1 number', 'error', 'pass_error');
			return false;
		} else {
			$scope.pass1_style = default_style;
			NotificationService.remove('pass_error');
		}

		// Password2
		if ($scope.pass1 != $scope.pass2) {
			$scope.pass2_style = error_style;
			NotificationService.send('Passwords can not be different', 'error', 'pass_error');
			return false;
		} else {
			$scope.pass2_style = default_style;
			NotificationService.remove('pass_error');
		}

		$http.post('app/src/user.php', {
			create: 1,
            name: $scope.login,
            mail: $scope.mail,
            pass: $scope.pass1,
        }).then(function(response){
            if (response.status == 200 && response.data == 0) {
            	NotificationService.send('Account creation succeeded, please sign in', 'info', 'register_state');
                window.location = '\#\\';
            } else {
                NotificationService.send('Some troubles happened with the account creation, please try later', 'error', 'register_state');
            }
        });
    };
});