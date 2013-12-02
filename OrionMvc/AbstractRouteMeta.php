<?php

namespace OrionMvc;
/**
 * This is class AbstractRouteMeta
 *
 */
abstract class AbstractRouteMeta
{
/**
	 * This is variable Route description
	 *
	 * @var mixed 
	 *
	 */
	public $Route;
	
	/**
	 * This is variable Router description
	 *
	 * @var mixed 
	 *
	 */	
	public $Router;
	
	/**
	 * This is variable Controller description
	 *
	 * @var mixed 
	 *
	 */	
	public $Controller;
	
	/**
	 * This is variable Action description
	 *
	 * @var mixed 
	 *
	 */	
	public $Action;
	
	/**
	 * This is variable Rule description
	 *
	 * @var mixed 
	 *
	 */	
	public $Rule;

	/**
	 * This is variable Params description
	 *
	 * @var mixed 
	 *
	 */
	public $Params;

	
	public	function __set($key,$value)
	{
		if($key == 'controller'|| $key == 'action'){
			$this->{ucfirst($key)} =ucfirst( $value);
		}else{
			$this->Params[$key] = $value;
		}
		//$this->{$key} = $value;
	}

	public	function __get($key)
	{
		if($key == 'Controller'|| $key == 'Action'){
			return	$this->{ucfirst($key)};
		}else{
			return $this->Params->{$key};
		}
		return $this->{$key};
	}
}
?>