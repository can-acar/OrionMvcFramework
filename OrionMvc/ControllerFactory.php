<?php

namespace OrionMvc;
use OrionMvc\Exception as Exception;
/**
 * This is class ControllerFactory
 *
 */
class ControllerFactory implements IControllerFactory
{
	/**
	 * This is variable Types description
	 *
	 * @var mixed 
	 *
	 */	
	private  $Types = NULL;
	/**
	 * This is method CreateController
	 *
	 * @param HttpContext $context This is a description
	 * @param RouteMeta $meta This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function CreateController(HttpContext $context,RouteMeta $meta)
	{
		if($meta->Controller == NULL)
			return NULL;
		
		$ControllerName =$meta->Controller;
				
		$Controller = $this->GetController(ucfirst($ControllerName));
		
		if($Controller == false)
		{
			
			 sprintf("%sController",  ucfirst($ControllerName));
			
			throw	OrionException::Handler(new Exception\OrionControllerException($ControllerName,$context));
			
		}
		
		$Controller = sprintf('\\%s\\%s',$Controller,sprintf("%sController",  ucfirst($ControllerName)));
		
		$Controller =new \ReflectionClass($Controller); 
		
		$Result = $Controller->newInstance($context);
	
		$Result->Context		= $context;
		$Result->Session		= $context->Session;
		$Result->Request		= $context->Request;
		$Result->Response		= $context->Response;		

		return $Result;
	}
	
	/**
	 * This is method GetController
	 *
	 * @param mixed $Controller This is a description
	 * @return namespace;
	 * 
	 */	
	public function GetController($Controller)
	{
		$ControllerName = sprintf("%sController",  $Controller);
		$Files         = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(ABSPATH),\RecursiveIteratorIterator::CHILD_FIRST);
		$GetMatchFiles = new \RegexIterator($Files, sprintf('/\b%s.php\b/i',$ControllerName));
		
		foreach ($GetMatchFiles as $File)
		{
			$collection = explode(DIRECTORY_SEPARATOR,$File->getPath());
			$findIndex = array_search($Controller,$collection );
			$split = array_slice($collection,($findIndex-1));
			$ns =  join("\\",$split);
			return $ns;

		}
		
		return false;
	}

}	

?>