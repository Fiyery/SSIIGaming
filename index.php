<html ng-app='application' ng-controller='MainController'>
<head>
	<title>{{title}}</title>
	<link type='text/css' rel='stylesheet' href='res/css/main.css'/>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/angularjs/1.4.6/angular.min.js'></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.6/angular-route.min.js"></script>
	<script type='text/javascript' src='res/js/app.js'></script> 
</head>
<body >
	<header>
		<nav>
			<a href=''>Home</a>
			<a href=''>Users</a>
			<a href=''>Consultants</a>
		</nav>
	</header>

	<div ng-view></div>

	<footer>

	</footer>
</body>
</html>

