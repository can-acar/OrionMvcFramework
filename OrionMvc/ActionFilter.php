<?php
namespace OrionMvc;

abstract class ActionFilter extends EventDispatcher  implements IActionFilter
{
	private $vars = array();
	
	public	function __construct()
	{
		$this->add("action.onExecuted",arra($this,"ActionExecuted"));
		$this->add("action.onExecuted",arra($this,"ActionExecuted"));
		return $this;
	}

	/*public	function ActionExecuted(ActionExecutedContext $filterContext)
	{
		$this->add($this,"ActionExecuted");
		//var_dump(get_called_class());
		
	}


	public    function ActionExecuting(ActionExecutedContext $filterContext)
	{
		var_dump(get_called_class());
	}

	public    function ActionResultExecuted(ActionExecutedContext $filterContext)
	{

	}

	public    function ActionResultExecuting(ActionExecutedContext $filterContext)
	{

	}*/
	public    function ActionExecuted(){
		
		$this->get("action.onExecuted");
	}
	
	public    function ActionExecuting(){
		$this->get("action.onExecuting");
	}
	


}


?>