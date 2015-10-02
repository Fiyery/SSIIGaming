<?php
require('app/lib/ClassLoader.class.php');
$class = new ClassLoader(array('app/lib', 'app/model', 'app/util'), 'class.php');
$config = json_decode(file_get_contents('app/config.json')); 
$base = new Base($config->base->engine, $config->base->host, $config->base->name, $config->base->user, $config->base->pass);
DAO::set_base($base);
$root_url = str_replace($_SERVER['DOCUMENT_ROOT'], 'http://'.$_SERVER['SERVER_NAME'].'/', str_replace('\\', '/', __DIR__)).'/';
$root_url .= '#/';


$c = Consultant::find();
$c[0]->remove();



?>

<html ng-app='application'>
<head>
	<title>{{title}}</title>

<?php 
	// CSS file Loading.
	$files = array_diff(scandir('res/css/'), array('..', '.'));
	foreach ($files as $f)
	{
		echo "<link type='text/css' rel='stylesheet' href='res/css/".$f."'/>";
	}
?>
	
	<script type='text/javascript' src='res/js/angular.min.js'></script> 
	<script type='text/javascript' src="res/js/angular-route.min.js"></script>
	<script type='text/javascript' src='res/js/app.js'></script> 

<?php 
	// JS file Loading.
	$files = array_diff(scandir('res/js/services/'), array('..', '.'));
	foreach ($files as $f)
	{
		echo "<script type='text/javascript' src='res/js/services/".$f."'></script>";
	}

	$files = array_diff(scandir('res/js/classes/'), array('..', '.'));
	foreach ($files as $f)
	{
		echo "<script type='text/javascript' src='res/js/classes/".$f."'></script>";
	}

	$files = array_diff(scandir('res/js/controllers/'), array('..', '.'));
	foreach ($files as $f)
	{
		echo "<script type='text/javascript' src='res/js/controllers/".$f."'></script>";
	}
?>

</head>
<body >
	<header>
		<nav>
			<a class='link' href='<?php echo $root_url; ?>'>Home</a>
			<a class='link' href='<?php echo $root_url; ?>consultant'>Consultants</a>
			<div ng-show='is_connected()'>
				Logged in {{get_user().name}}
				<a href='<?php echo $root_url; ?>sign-out'><button>Sign out</button></a>
			</div>
		</nav>

		<div id='notification_bloc'>
			<div ng-repeat='msg in _msg' class='notification {{msg.type}}'>
				{{msg.value}}
				<div class='remove' ng-click='remove_msg(msg.id)'>&times;</div>
			</div>
		</div>
	</header>

	<div id='content' ng-view></div>

	<footer></footer>
</body>
</html>

