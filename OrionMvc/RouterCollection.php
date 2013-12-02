<?php
namespace OrionMvc;
/**
 * class RouterCollection
 *
 * Description for class RouterCollection
 *
 * @author:
*/
class RouterCollection extends \ArrayObject  {
	
	
	/**
	 * This is variable Collection description
	 *
	 * @var $Collection Array; 
	 *
	 */
	//protected $Collection = array();
	/**
	 * RouterCollection constructor
	 *
	 * @param 
	 */
	public function __construct() {
		return $this;
	}


	public function Add($Key,$Value)
	{
		$this[$Key]=($Value);
		
		return $this;
	}

	public function Get()
	{
		return $this->getIterator();
	}

	
	public function GetController($Default)
	{
		if(in_array($Default,$this)==true)
		{
			return	$this[$Default]->controller;	
		}


	}

}

?>