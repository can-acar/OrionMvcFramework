<?php
namespace OrionMvc;


/**
 * This is class AbstractRoute
 *
 */
abstract class  AbstractRoute
{
	/**
	 * This is variable Path description
	 *
	 * @var mixed 
	 *
	 */	
	public $Path;
	/**
	 * This is variable Default description
	 *
	 * @var mixed 
	 *
	 */	
	protected $Default = array();
	/**
	 * This is variable Controller description
	 *
	 * @var mixed 
	 *
	 */	
	//public $Controller;
	/**
	 * This is variable Action description
	 *
	 * @var mixed 
	 *
	 */	
	//public $Action;
	/**
	 * This is variable Rule description
	 *
	 * @var mixed 
	 *
	 */	
	public $Rule = array();
	/**
	 * This is method __set
	 *
	 * @param mixed $key This is a description
	 * @param mixed $value This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function __set($key,$value)
	{
		if($key == 'controller'|| $key == 'action'){
			$this->{ucfirst($key)} =ucfirst( $value);
		}else{
			$this->{ucfirst($key)} = $value;
		}
		
	}
	/**
	 * This is method __get
	 *
	 * @param mixed $key This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function __get($key)
	{
		return $this->{ucfirst($key)};
	}
}
?>