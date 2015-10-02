<?php
/**
 * Base deliver database access.
 */
class Base 
{
	private $_connection = NULL;

	public function __construct($engine, $host, $name, $user, $pass)
	{
		$this->_connection = new PDO($engine.':dbname='.$name.';host='.$host, $user, $pass);
	}

	public function __call($name, $args) 
	{
		return call_user_func_array(array($this->_connection, $name), $args);
	}
}

?>