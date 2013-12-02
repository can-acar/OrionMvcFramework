<?php
namespace OrionMvc;



class ActionExecutedContext  implements IController
{
	public function __construct()
	{
		
	}
	
	public function Execute(HttpContext $Context, RouteMeta $RouteMeta)
	{
	}
	/**
	 * This is function Render
	 *
	 * @param HttpContext $Context This is a description
	 * @param mixed $View This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function Render(HttpContext $Context,$Path,$View)
	{}
}
?>