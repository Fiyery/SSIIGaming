<?php
require('../lib/ClassLoader.class.php');
$class = new ClassLoader(array('../lib', '../model'), 'class.php');
$config = json_decode(file_get_contents('../config.json')); 
$base = new Base($config->base->engine, $config->base->host, $config->base->name, $config->base->user, $config->base->pass);
DAO::set_base($base); 
$data = file_get_contents("php://input");
$data = json_decode($data, true);

if (isset($data['login']) && isset($data['pass']))
{
	$user = User::find(array('name'=>$data['login']));
	if (count($user) > 0) 
	{
		if (password_verify($data['pass'], $user[0]->password))
		{
			echo json_encode($user[0]);
		}
		else 
		{
			echo 0;
		}
	}
	else
	{
		echo 0;
	}
}

if (isset($data['create']) && isset($data['name']) && isset($data['mail']) && isset($data['pass']))
{
	$user = new User(array('name' => $data['name'], 'mail' => $data['mail'], 'password' => password_hash($data['pass'], PASSWORD_BCRYPT)));
	if ($user->save()) 
	{
		echo 0;
	}
	else
	{
		echo 1;
	}
}
?>