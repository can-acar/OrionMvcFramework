<?php

namespace OrionMvc;
/**
 * class EventDispacher
 *
 * Description for class EventDispacher
 *
 * @author:
*/
class EventDispatcher implements IEventDispathcer  {
	/**
	 * This is variable _events description
	 *
	 * @var mixed 
	 *
	 */
	private $_events = array(); 
	/**
	 * EventDispacher constructor
	 *
	 * @param 
	 */
	public function __construct()
	{
	
	}
	
	
	public function count()
	{
		return count($this->_events);
	}
	
	/**
	 * Add a new event by name.
	 *
	 * @access	public
	 * @param	string	$name
	 * @param	mixed	$triggersMethod
	 * @return	Event
	 */
	public function add($name, $triggersMethod = null)
	{
	
		if (!isset($this->_events[$name])) 
		{
			
			$this->_events[$name] = new Event($triggersMethod);
		
		}
		return $this->_events[$name];
	}

	/**
	 * Retrieve an event by name. If one does not exist, it will be created
	 * on the fly.
	 *
	 * @access	public
	 * @param	string	$name
	 * @return	Event
	 */
	public function get($name)
	{
		if (!isset($this->_events[$name])) {
			return $this->add($name);
		}
		return $this->_events[$name];
	}

	/**
	 * Retrieves all events.
	 *
	 * @access	public
	 * @return	array
	 */
	public function getAll()
	{
		return $this->_events;
	}

	/**
	 * Trigger an event. Returns the event for monitoring status.
	 *
	 * @access	public
	 * @param	string	$name
	 * @param	mixed	$data	The data to pass to the triggered event(s)
	 * @return	void
	 */
	public function trigger($name, $data)
	{
		$this->get($name)->notify($data);
	}

	/**
	 * Remove an event by name.
	 *
	 * @access	public
	 * @param	string	$name
	 * @return	bool
	 */
	public function remove($name)
	{
		if (isset($this->_events[$name])) {
			unset($this->_events[$name]);
			return true;
		}
		return false;
	}
	
	/**
	 * Retrieve the names of all current events.
	 *
	 * @access	public
	 * @return	array
	 */
	public function getNames()
	{
		return array_keys($this->_events);
	}                   
	
	/**
	 * Magic __get method for the lazy who don't wish to use the
	 * add() or get() methods. It will add an event if it doesn't exist,
	 * or simply return an existing event.
	 *
	 * @access	public
	 * @return	Event
	 */
	public function __get($name)
	{ 
		return $this->add($name);
	}
}

interface IEventDispathcer
{
	public function count();
	/**
	 * This is function add
	 *
	 * @param mixed $name This is a description
	 * @param mixed $triggersMethod This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function add($name, $triggersMethod = null);
	
	/**
	 * This is function get
	 *
	 * @param mixed $name This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function get($name);
	
	/**
	 * This is function getAll
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public function getAll();
	/**
	 * This is function trigger
	 *
	 * @param mixed $name This is a description
	 * @param mixed $data This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function trigger($name, $data);
	/**
	 * This is function remove
	 *
	 * @param mixed $name This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function remove($name);
	/**
	 * This is function getNames
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public function getNames();
	
	
}


?>