<?php
require('../lib/ClassLoader.class.php');
$class = new ClassLoader(array('../lib', '../model', '../util'), 'class.php');
$config = json_decode(file_get_contents('../config.json')); 
$base = new Base($config->base->engine, $config->base->host, $config->base->name, $config->base->user, $config->base->pass);
DAO::set_base($base); 
$data = file_get_contents("php://input");
$data = json_decode($data, true);

if (isset($_GET['trigger_event']))
{
	$em = new EventManager($config);
	$r = new Recruitment($em);
	$r->set_frequency($config->event->frequency_recruitement);
	$r->set_max_departure_frequency($config->event->max_frequency_departure);
	$r->set_min_departure_frequency($config->event->min_frequency_departure);
	$em->add($r);
	$em->occur();
}

?>