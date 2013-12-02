<?php
namespace OrionMvc;
/**
 * This is interface IRouter
 *
 */
interface IRouter
{
	/**
	 * This is function Dispatch
	 *
	 * @param HttpContext $Context This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function Dispatch(HttpContext $Context);
	
	
	
	/**
	 * This is function Connect
	 *
	 * @param mixed $Path This is a description
	 * @param mixed $Defualt This is a description
	 * @param mixed $Filter This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public static function Connect($Name, $Path ,array $Defualt ,array $Filter=null);

	
	/**
	 * This is function AddRoute
	 *
	 * @param Route $Route This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public static function AddRoute(Route $Route,$Name);


}

?>