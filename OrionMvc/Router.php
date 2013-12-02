<?php
namespace OrionMvc;
/**
* This is class Router
*
*/
class Router extends AbstractRouter implements IRouter{

	
	const QUERY_STRING_PARAMS = '&(?=[^=]*&)';
	/**
	* This is variable RouteMeta description
	*
	* @var mixed 
	*
	*/	
	public $RouteMeta;
	
	/**
	* This is variable RouterCollection description
	*
	* @var mixed 
	*
	*/	
	public static $RouterCollection;
	

	
	/**
	* This is method __construct
	*
	* @return mixed This is the return value description
	*
	*/
	public function __construct()
	{
		$this->RouteMeta = new RouteMeta;
		$this->RouteMeta->Router = $this;
		self::$RouterCollection = new RouterCollection;

	}
	
	/**
	* This is method Dispatch
	*
	* @param HttpContext $context This is a description
	* @return mixed This is the return value description
	*
	*/
	
	public function Dispatch(HttpContext $context){
		
		$App = \Application::$Instance;

		$Path = $context->Request->Path;
		
		$App->Router->Match(trim($Path,'/'));
		
		$RouteMeta = $App->Router->RouteMeta;
		
		$Controller = $App->ControllerFactory->CreateController($context,$this->RouteMeta);
		
		$Controller->Execute($context,$RouteMeta);
		
		
	}
	
	/**
	* This is method Match
	*
	* @param mixed $Url This is a description
	* @return mixed This is the return value description
	*
	*/	
	public function Match($Url){
		
		
		foreach(self::$RouterCollection as $route)
		{
			
			$this->RouteMeta->Route = $route;
			$this->RouteMeta->Rule  = $route->Rule;
			$Default = $route->GetDefault();
			$Regex = $route->getUrlSchema();
			
			$params= array();
			$isMatched = false;
			if( preg_match($Regex,$Url, $matches)==true)
			{
				$isMatched = true;
			}
			

			
			foreach($matches as $key => $value)
			{
				if(!is_int($key)&&!is_null($key)&&!is_numeric($key))
				{
					if($value != '')
					{
						$params[$key]=$value;
					}
					
				}
				
			}unset($matches,$key,$value);
			
			$merge = array_merge($Default, $params);
			
			foreach($merge as $key=>$value)
			{

				$this->RouteMeta->{$key} = $value;
				//$this->RouteMeta->Route->{$key} = $value;		
			}
					
			if($isMatched == true)
			{
				return true;
			}
			
			
		}
	}
	/**
	* This is method Connect
	*
	* @param mixed $Path This is a description
	* @param mixed $Defualt This is a description
	* @param mixed $Filter This is a description
	* @return mixed This is the return value description
	*
	*/	
	public static function Connect($Name, $Path ,array $Defualt ,array $Filter=null)
	{
		
		$Route = new Route($Path,$Defualt,$Filter);
		
		self::AddRoute($Route,$Name);
		
		return $Route; 
		
	}
	
	/**
	* This is method AddRoute
	*
	* @param Route $Route This is a description
	* @return mixed This is the return value description
	*
	*/	
	public static function AddRoute(Route $Route,$Name){
		self::$RouterCollection->Add($Name ,$Route);
		
	}
	
	
	public static function IgnoreRoute()
	{
		
	}
	
	
	
	
}
?>