app.service('UserService', function($rootScope, $http){
	return {
        is_connected: function() {
            return ($rootScope._user);
        },
        sign_in: function(login, pass) {
            $http.post('app/user.php').then(function(response){
                if (response.data) {
                    $rootScope._user = response.data;
                    alert('connected');
                    return true;
                } else {
                    alert('try angain');
                    return false;
                }
            });
        },
        sign_out: function() {
            $rootScope._user = null;
        },
        get_user: function() {
        	return $rootScope._user;
        }
    };
});
