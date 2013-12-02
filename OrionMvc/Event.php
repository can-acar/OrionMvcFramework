<?php
namespace OrionMvc;
/**
 * class Event
 *
 * Description for class Event
 *
 * @author:
*/
class Event implements \SplSubject  {

	private $_observers;
	
	/**
	 * Default constructor to initialize the observers.
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		$this->_observers = new \SplObjectStorage();
	}
	
	/**
	 * Wrapper for the attach method, allowing for the addition
	 * of a method name to call within the observer.
	 *
	 * @access	public
	 * @param	SplObserver	$event
	 * @param	mixed		$triggersMethod
	 * @return	Event
	 */
	public function bind(\SplObserver $event, $triggersMethod = NULL)
	{
		$this->_observers->attach($event, $triggersMethod);
		return $this;
	}

	/**
	 * Attach a new observer for the particular event.
	 *
	 * @access	public
	 * @param	SplObserver	$event
	 * @return	Event
	 */
	public function attach(\SplObserver $event)
	{             
		$this->_observers->attach($event);      
		return $this;
	}

	/**
	 * Detach an existing observer from the particular event.
	 *
	 * @access	public
	 * @param	SplObserver	$event
	 * @return	Event
	 */
	public function detach(\SplObserver $event)
	{           
		$this->_observers->detach($event);                
		return $this;
	}

	/**
	 * Notify all event observers that the event was triggered.
	 *
	 * @access	public
	 * @param	mixed	&$args
	 */
	public function notify(&$args = null)
	{
		$this->_observers->rewind();
		while ($this->_observers->valid()) {
			$triggersMethod = $this->_observers->getInfo();
			$observer = $this->_observers->current();
			$observer->update($this, $triggersMethod, $args);

			// on to the next observer for notification
			$this->_observers->next();
		}
	}
	
	/**
	 * Retrieves all observers.
	 *
	 * @access	public
	 * @return	SplObjectStorage
	 */
	public function getHandlers()
	{
		return $this->_observers;
	}
}

?>