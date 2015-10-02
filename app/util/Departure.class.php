<?php 
/**
 * Departure event class when a new consultant arrive in game, he can quit the company.
 */
class Departure extends Event
{
	protected function _handle() 
	{		
		// Remove event.
		$this->_event_manager->remove(get_class($this).':'.$this->_id);

		// Remove consultant.
		$consultants = Consultant::find(array('id'=>$this->_id));
		if (count($consultants) > 0)
		{
			$consultants[0]->remove();
		}
	}
}
?>