app.controller('SignOutController', function($scope, $location, NotificationService, UserService){
	UserService.sign_out();
	NotificationService.send('Your session is closed', 'info', 'login_state')
	$location.url('/');
});