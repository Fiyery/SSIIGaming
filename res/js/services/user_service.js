app.service('UserService', function($rootScope, $http){
	this.is_connected = function() {
        return ($rootScope._user) ? (true) : (false);
    };
    this.sign_out = function() {
        $rootScope._user = null;
    };
    this.sign_in = function(login, pass) {
        var that = this;
        return $http.post('app/src/user.php', {
            login: login,
            pass: pass
        }).then(function(response){
            if (response.status == 200 && response.data != 0) {
                $rootScope._user = response.data;
                return true;
            } else {
                that.sign_out();
                return false;
            }
        });
    };
    this.get_user = function() {
    	return $rootScope._user;
    };
});
