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
		$d = new Departure($this->_event_manager);
		$d->set_id($this->_id++);
		mt_srand();
		$d->set_frequency(mt_rand($this->_min_departure_frequency, $this->_max_departure_frequency));
		$this->_event_manager->add($d);
	}
}
?>