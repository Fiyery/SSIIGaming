<?php
require('../lib/ClassLoader.class.php');
$class = new ClassLoader(array('../lib', '../model'), 'class.php');
$config = json_decode(file_get_contents('../config.json')); 
$base = new Base($config->base->engine, $config->base->host, $config->base->name, $config->base->user, $config->base->pass);
DAO::set_base($base);

if (isset($_GET['login']) && isset($_GET['pass']))
{
	$users = User::find(array('name'=>'Yoann'));
	var_dump($users);
}
?>