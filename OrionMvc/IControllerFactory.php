<?php
namespace OrionMvc;
/**
  *   class IControllerFactory 
  */

interface IControllerFactory
{
	/**
	* @method CreateController(HttpContext $context,RouteMeta $meta)
	* @param HttpContext $context
	* @param RouteMeta $meta
	* 
	*/
 	public function	CreateController(HttpContext $context,RouteMeta $meta);
}

?>