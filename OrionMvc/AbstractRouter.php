<?php

namespace OrionMvc;

abstract class AbstractRouter
{		
		
	/**
	 * This is variable RouteMeta description
	 *
	 * @var mixed 
	 *
	 */					
	public $RouteMeta;
	/**
	 * This is variable RouterCollection description
	 *
	 * @var mixed 
	 *
	 */	
	public static $RouterCollection;


	/**
	 * This is method Dispatch
	 *
	 * @param HttpContext $Context This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public  function Dispatch(HttpContext $Context){}

	
	/**
	 * This is method Connect
	 *
	 * @param mixed $Path This is a description
	 * @param mixed $Defualt This is a description
	 * @param mixed $Filter This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public static	function Connect($Name, $Path ,array $Defualt ,array $Filter=null){}

	

	/**
	 * This is method AddRoute
	 *
	 * @param Route $route This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public static function AddRoute(Route $route,$Name){}
	
	

}
?>