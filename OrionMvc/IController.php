<?php

namespace OrionMvc;
/**
 * This is interface IController
 *
 */
interface IController
{
	
	
	
	/**
	 * This is function Execute
	 *
	 * @param HttpContext $Context This is a description
	 * @param RouteMeta $RouteMeta This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public function Execute(HttpContext $Context, RouteMeta $RouteMeta);
	/**
	 * This is function Render
	 *
	 * @param HttpContext $Context This is a description
	 * @param mixed $View This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function Render(HttpContext $Context,$Path,$View);
	

}