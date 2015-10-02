<?php
/**
 * Class give all main methods of model object to the database.
 */
class DAO 
{
	protected static $_base;

	public function __construct(array $properties = [])
	{
		foreach ($properties as $name => $value)
		{
			$this->$name = $value;
		}
	}

	public static function set_base(Base $base) 
	{
		self::$_base = $base;
	}

	/**
	 * @param array $field Associative array, name and value, of table fields
	 */
	public static function find($fields=array()) 
	{
		$class = get_called_class();
		$table = strtolower($class);
		$req = 'SELECT * FROM '.$table;
		$values = [];
		if (count($fields) > 0)
		{
			$req .= ' WHERE ';
			$where = [];
			foreach ($fields as $n => $v)
			{
				$values[] = $v;
				$where[] = ' '.$n.' = ? ' ;
			}
			$req .= implode(' AND ', $where);
		}
		$result = self::$_base->prepare($req);
		$result->execute($values);
		$list = $result->fetchAll(PDO::FETCH_ASSOC);
		$objects = [];
		foreach ($list as $l)
		{
			$objects[] = new $class($l);
		}
		return $objects;
	}

	public function save()
	{
		$table = strtolower(get_called_class());
		$fields = array_values(get_object_vars($this));
		$req = 'REPLACE '.$table.' VALUES ('.implode(',', array_fill(0, count($fields), '?')).')';
		$result = self::$_base->prepare($req);
		$result->execute($fields);
	}

	public function remove()
	{
		$table = strtolower(get_called_class());
		$fields = array_keys(get_object_vars($this));
		$req = 'DELETE FROM '.$table.' WHERE ';
		$sql_values = [];
		foreach ($fields as $f)
		{
			$req .= ' '.$f. ' = ? AND';
			$sql_values[] = $this->$f;
		}
		$req = substr($req, 0, -3);
		var_dump($req);
	}
}
?>