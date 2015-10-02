<?php 
/**
 * Recruitment event class when a new consultant arrive in game.
 */
class Recruitment extends Event
{
	/**
	 * Define the maximum for the departure frequency.
	 * @var int
	 */
	private $_max_departure_frequency = 10;

	/**
	 * Define the minimum for the departure frequency.
	 * @var int
	 */
	private $_min_departure_frequency = 1;

    /**
     * Gets the Define the maximum for the departure frequency.
     * @return int
     */
    public function get_max_departure_frequency()
    {
        return $this->_max_departure_frequency;
    }

    /**
     * Sets the Define the maximum for the departure frequency.
     * @param int $_max_departure_frequency the _max_departure_frequency
     * @return self
     */
    public function set_max_departure_frequency($_max_departure_frequency)
    {
        $this->_max_departure_frequency = $_max_departure_frequency;

        return $this;
    }

    /**
     * Gets the Define the minimum for the departure frequency.
     * @return int
     */
    public function get_min_departure_frequency()
    {
        return $this->_min_departure_frequency;
    }

    /**
     * Sets the Define the minimum for the departure frequency.
     * @param int $_min_departure_frequency the _min_departure_frequency
     * @return self
     */
    public function set_min_departure_frequency($_min_departure_frequency)
    {
        $this->_min_departure_frequency = $_min_departure_frequency;

        return $this;
    }

	protected function _handle() 
	{
		var_dump("Recruit !");
        // Creation of consultant.
        $max = $this->_event_manager->get_config()->entity->max_consultant_begin_wage;
        $min = $this->_event_manager->get_config()->entity->min_consultant_begin_wage;
        $f = fopen("../../data/name.txt", "r");
        $name = [];
        while ($data = fgetcsv($f, 0, "\t")) 
        {
            if (stripos($data[2], $this->_event_manager->get_config()->app->lang) !== FALSE) 
            {
                $name[] = $data[0];
            }
        }
        $name = ucfirst($name[array_rand($name)]);
        if (substr($name, 0, 1) == 'é') 
        {
            $name = 'E'.substr($name, 1);
        }
        $consultant = Consultant::generate($id, $name, $min, $max);
        $consultant->save();

        // Add departure event for this consultant.
        $d = new Departure($this->_event_manager);
        $d->set_id($this->_id++);
        mt_srand();
        $d->set_frequency(mt_rand($this->_min_departure_frequency, $this->_max_departure_frequency));
        $this->_event_manager->add($d);
	}
}
?>

