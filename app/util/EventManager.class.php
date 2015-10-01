<?php
class EventManager
{
	/**
	 * List of events.
	 * @var array
	 */
	private $_events = [];

	public function __construct()
	{

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
            $e->occur();
        }
    }
}
?>