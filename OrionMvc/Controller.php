<?php

namespace OrionMvc;
/**
 * class Controller
 *
 * Description for class Controller
 *
 * @author:
*/
abstract class Controller extends AbstractController implements IController  {

	private $ResponseContent = null;
	
	public $Name = null;
	
	public $json = false;
	
	private $Controller;
	
	public function __construct(HttpContext $Context)
	{
	
		//$this->Context=$Context;
		$this->ViewData = new ViewData();
		//$this->ActionExecuted();
		//$this->ActionExecuting();
		
		return $this;
	}
	
	public function Render(HttpContext $Context ,$controller,$View)
	{
		$_Body = \Application::$Instance->View->Render($this,$controller,$View);
		$Context->Response->SetBody( $_Body );
		
	}
	
	
	public function Execute(HttpContext $Context,RouteMeta $RouteMeta)
	{
		$this->Controller = $RouteMeta->Controller;
		$ActionName = $RouteMeta->Action;
		$_Action = $this->FindAction($ActionName);
		$ActionName = $this->Name;
		$Controller = $RouteMeta->Controller;
		//$this->ActionExecuting($_Action);
		//Todo: InvokeActionFilter($_Action);
		$InvokeActionFilter = new InvokeActionFilter($_Action);
		$this->InvokeAction($_Action);
		//echo($_Action->getDocComment());
		//$this->ActionExecuted($_Action);
		
		if (!is_null($ActionName)) {
			$ActionName = $this->ViewName;
		}


		if($Context->Request->isAjax == false)
			$this->Render($Context,$Controller,$ActionName);
		
		$Context->Response->Send();
		
	}
	
	public function FindAction($Name)
	{
		try{
			
			$this->Name = ucfirst($Name);
			
			$Action =  new \ReflectionMethod($this,$this->Name);
			
			return $Action;
			
		}catch(\ReflectionException $e){

			throw OrionException::Handler(new Exception\OrionControllerActionException($this->Controller,$this->Name,$this->Context));
		}
		
	}
	
	
	public function GetActionList()
	{
		return	$this->getMethods();
	}
	
	public function InvokeAction($_Action)
	{
		$GetParams = $_Action->getParameters();
		//var_dump($_Action);		
		$_Action->invokeArgs($this,array());
		
	}
	
	public function Json($Object)
	{
		return new Json($Object);
	}
	
	
}

?>