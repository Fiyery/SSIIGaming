<?php
class Consultant extends DAO
{
	public $id = '';

	public $name;

	public $wage;

	public $employed_date;

	public $id_user;

	/**
	 * Get the max id.
	 * @return int
	 */
	public static function get_max_id()
	{
		$req = "SELECT MAX(id) max FROM ".strtolower(__CLASS__);
		$result = self::$_base->prepare($req);
		$result->execute();
		$row = $result->fetchAll(PDO::FETCH_ASSOC);
		if (count($row) > 0)
		{
			return $row[0]['max'];
		}
		else
		{
			return 0;
		}
	}

	/**
	 * Create un random instance of Consultant.
	 * @return Consultant
	 */
	public static function generate($id, $name, $min_wage, $max_wage)
	{
		mt_srand();
		$wage = round(number_format(mt_rand($min_wage, $max_wage), 0, '.', ''), -2);

		$instance = new Consultant(array(
			'id' => $id,
			'wage' => $wage,
			'name' => $name,
			'employed_date' => time(),
			'id_user' => 0
		));
		return $instance;
	}
}
?>