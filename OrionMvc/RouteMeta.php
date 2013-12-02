<?php
namespace OrionMvc;
/**
* class RouterMeta
*
* Description for class RouterMeta
*
* @author:
*/

class RouteMeta   extends AbstractRouteMeta implements IRouteMeta
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

}

?>