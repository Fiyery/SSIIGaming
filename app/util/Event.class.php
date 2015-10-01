<?php
/**
 * Main class of event game.
 */
class Event 
{
	/**
	 * Number between 0 and 100.
	 */
	protected $_frequency = 0;

	protected $_id = 0;

	protected $_event_manager = NULL;

	public function __construct(EventManager $event_manager) 
	{
		$this->_event_manager = $event_manager;
	}

	/**
     * Gets the Number between 0 and 100.
     * @return mixed
     */
    public function get_frequency()
    {
        return $this->_frequency;
    }

    /**
     * Sets the Number between 0 and 100.
     * @param mixed $_frequency the _frequence
     * @return self
     */
    public function set_frequency($_frequency)
    {
        $this->_frequency = $_frequency;
        return $this;
    }

    /**
     * Gets the value of _id.
     * @return mixed
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Sets the value of _id.
     * @param mixed $_id the _id
     * @return self
     */
    public function set_id($_id)
    {
        $this->_id = $_id;
        return $this;
    }

    /**
     * Gets the value of _event_manager.
     * @return mixed
     */
    public function get_event_manager()
    {
        return $this->_event_manager;
    }

    /**
     * Sets the value of _event_manager.
     * @param mixed $_event_manager the _event_manager
     * @return self
     */
    public function set_event_manager($_event_manager)
    {
        $this->_event_manager = $_event_manager;

        return $this;
    }

	/**
	 * Trigger the event according to the probability.
	 * @return boolean
	 */
	public function occur() 
	{
		mt_srand();
		if (mt_rand(0, 100) <= $this->_frequency) 
		{
			$this->_handle();
		}
	}

	/**
	 * Event action.
	 */
	protected function _handle() 
	{

	}
}
?>