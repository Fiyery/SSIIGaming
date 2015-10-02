<?php
/**
 * Class handles and load events.
 */
class EventManager
{
	/**
	 * List of events.
	 * @var array
	 */
	private $_events = [];

    /**
     * List of events occured.
     * @var array
     */
    private $_occured = [];

    /**
     * List the site parameters.
     * @var Object
     */
    private $_config;

	public function __construct($config)
	{
        $this->_config = $config;
	}

    /**
     * Get the List of events.
     * @return array
     */
    public function get()
    {
        return $this->_events;
    }

    /**
     * Gets the List the site parameters.
     * @return Object
     */
    public function get_config()
    {
        return $this->_config;
    }

    /**
     * Add the List of events.
     * @param Event $event the event
     */
    public function add(Event $event)
    {
        $class = get_class($event);
        $this->_events[$class.':'.$event->get_id()] = $event;
    }

    /**
     * Delete one event of the List of events.
     * @param string $id Identifiant composed by the classname follow be ":" and id event.
     */
    public function remove($id)
    {
        unset($this->_events[$id]);
    }

    /**
     * Trigger all events in list.
     */
    public function occur()
    {
        foreach ($this->_events as $e)
        {
            $this->_occured[] = $e;
            $e->occur();
        }
    }

    /**
     * Load all event.
     * @param Base $base Instance of database.
     */
    public function load(Base $base) 
    {
        // Recruitment event.
        $r = new Recruitment($this);
        $r->set_frequency($this->_config->event->frequency_recruitement);
        $r->set_max_departure_frequency($this->_config->event->max_frequency_departure);
        $r->set_min_departure_frequency($this->_config->event->min_frequency_departure);
        $r->set_id(Consultant::get_max_id() + 1);
        $em->add($r);

        // Departure events for existed consultants.
        $consultant = Consultant::find();
        foreach ($consultants as $c)
        {
            $d = new Departure($this);
            $d->set_id($c->id);
            mt_srand();
            $d->set_frequency(mt_rand($this->_min_departure_frequency, $this->_max_departure_frequency));
            $this->add($d);
        }
        $em->occur();
    }
}
?>