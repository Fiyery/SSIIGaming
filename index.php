<?php
$root_url = str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['SERVER_NAME'].'/', str_replace('\\', '/', __DIR__)).'/';
?>

<html ng-app='application' ng-controller='MainController'>
<head>
	<title>{{title}}</title>
	<link type='text/css' rel='stylesheet' href='res/css/main.css'/>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/angularjs/1.4.6/angular.min.js'></script> 
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.6/angular-route.min.js"></script>
	<script type='text/javascript' src='res/js/app.js'></script> 
	<script type='text/javascript' src='res/js/services/user_service.js'></script> 
	<script type='text/javascript' src='res/js/services/notification_service.js'></script> 
	<script type='text/javascript' src='res/js/controllers/index_controller.js'></script> 
	<script type='text/javascript' src='res/js/controllers/user_controller.js'></script> 
</head>
<body >
	<header>
		<nav>
			<a href='<?php echo $root_url; ?>#/'>Home</a>
			<a href='<?php echo $root_url; ?>#/user/'>Users</a>
			<a href='<?php echo $root_url; ?>#/consultant'>Consultants</a>
		</nav>
		<div id='notification_bloc'>
			<div ng-repeat='msg in _msg' class='notification {{msg.type}}'>
				{{msg.value}}
				<div class='remove' ng-click='remove_msg(msg.id)'>X</div>
			</div>
		</div>
	</header>
	<div id='content' ng-view></div>

	<footer>
	</footer>
</body>
</html>

