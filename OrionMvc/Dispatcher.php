<?php
namespace OrionMvc;
/**
 * class Dispatcher
 *
 * Description for class Dispatcher
 *
 * @author:
*/
class Dispatcher  
{
	
	protected $application = NULL;

	/**
	 * Dispatcher constructor
	 *
	 * @param 
	 */
	public function __contruct($instance)
	{
		$this->application = $instance;
		return $this;
	}
	
	public function Dispatch(HttpContext $Context,$App)
	{
		try{
            $App->Event->Dispatch->onInit($Context);
				
			$Path = $Context->Request->Path;
						
			$App->Router->Match(trim($Path,'/'));
			
			$RouteMeta = $App->Router->RouteMeta;
			
			$App->Event->Dispatch->onActionExecuting($Context);
			
			$Controller = $App->ControllerFactory->CreateController($Context,$RouteMeta);
			
			$App->Event->Dispatch->onActionPreExecuting(array($Context,$RouteMeta));
		
			$App->Event->Dispatch->onActionResult($Context);
			
			$Controller->Execute($Context,$RouteMeta);
			
			$App->Event->Dispatch->onActionExecuted(array($Context,$RouteMeta));
			
			
			
		}catch(Exception $e)
		{
			OrionException::Handler(new Exception\ErrorException("Application Dispatch Error!"));
			return FALSE;
		}
	}
}

?>