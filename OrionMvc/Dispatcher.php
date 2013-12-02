<?php
namespace OrionMvc;
/**
 * class Dispatcher
 *
 * Description for class Dispatcher
 *
 * @author:
*/
class Dispatcher  {

	/**
	 * Dispatcher constructor
	 *
	 * @param 
	 */
	public function __contruct()
	{
		
	}
	
	public function Dispatch(HttpContext $Context)
	{
		try{
			
			$App = \Application::$Instance;

			$Path = $Context->Request->Path;
			
			$App->Router->Match(trim($Path,'/'));
			
			$RouteMeta = $App->Router->RouteMeta;
			
			$Controller = $App->ControllerFactory->CreateController($Context,$RouteMeta);
			
			
			$Controller->Execute($Context,$RouteMeta);
			
		}catch(Exception $e)
		{
			OrionException::Handler(new \ErrorException("Application Error!"));
			return FALSE;
		}
	}
}

?>