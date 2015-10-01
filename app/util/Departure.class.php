<?php 
/**
 * Departure event class when a new consultant arrive in game, he can quit the company.
 */
class Departure extends Event
{
	protected function _handle() 
	{
		$this->_event_manager->remove(get_class($this).':'.$this->_id);
	}
}
?>