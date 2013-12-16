<?php
namespace OrionMvc;
/**
 * class EventListener
 *
 * Description for class EventListener
 *
 * @author:
*/
abstract class EventListener implements \SplObserver  {

	// holds all states
	private $_states = array();

	/**
	 * Returns all states.
	 *
	 * @access	public
	 * @return	void
	 */
	public function getStates()
	{
		return $this->_states;
	}

	/**
	 * Adds a new state.
	 *
	 * @access	public
	 * @param	mixed	$state
	 * @param	int		$stateValue
	 * @return	void
	 */
	public function addState($state, $stateValue = 1)
	{
		$this->_states[$state] = $stateValue;
	}

	/**
	 * @Removes a state.
	 *
	 * @access	public
	 * @param	mixed	$state
	 * @return 	bool
	 */
	public function removeState($state)
	{
		if ($this->hasState($state)){
			unset($this->_states[$state]);
			return TRUE;   
		}        
		return FALSE;
	}

	/**
	 * Checks if a given state exists.
	 *
	 * @access	public
	 * @param	mixed	$state
	 * @return	bool
	 */
	public function hasState($state)
	{
		return isset($this->_states[$state]);        
	}
	
	/**
	 * Implementation of SplObserver::update().
	 *
	 * @access	public
	 * @param	SplSubject	$subject
	 * @param	mixed		$triggersMethod
	 * @param	mixed		&$arg			Any passed in arguments
	 */
	public function update(\SplSubject $subject, $triggersMethod = NULL, &$arg = NULL) {
		if ($triggersMethod) {
			if (method_exists($this, $triggersMethod)) {
				$this->{$triggersMethod}($arg);
			} else {
				throw OrionException::Handler(new ErrorException('The specified event method ' . get_called_class() . '::' . $triggersMethod . ' does not exist.'));
			}
		} else {
			throw OrionException::Handler(new ErrorException('The specified event method ' . get_called_class() . '::' . 'update() does not exist.'));
		}
	}

}

?>