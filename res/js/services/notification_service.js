app.service('NotificationService', function($rootScope){
	this.init = function() {
        if (!$rootScope._msg) {
            $rootScope._msg = [];
        }
    };
    // Possible types : info, error, warning, success.
    // With id, the message will be unique and show one time. 
    this.send = function(msg, type, id=null) {
        this.init();
        if (type != 'info' && type != 'error' && type != 'warning' && type != 'success') {
            type = 'info';
        }
        if (!id) {
            id = Math.random();
        } else {
            this.remove(id);
        }
        $rootScope._msg.push({
            'value' : msg,
            'type' : type,
            'id': id
        });
        return true;
    };
    this.find = function(id) {
        this.init();
        msg = null;
        angular.forEach($rootScope._msg, function(value) {
            if (value.id == id) {
                msg = value;
                return true;
            }
        });
        return msg;
    };
    this.remove = function(id) {
        this.init();
        var key_suppr = -1;
        angular.forEach($rootScope._msg, function(value, key) {
            if (value.id == id) {
                key_suppr = key;
                return true;
            }
        });
        if (key_suppr > -1) {
            $rootScope._msg.splice(key_suppr, 1);
        }
    };
    this.remove_all = function() {
        this.init();
        $rootScope._msg = [];
    };
});