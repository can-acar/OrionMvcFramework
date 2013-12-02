<?php
namespace OrionMvc;

/**
 * This is class HttpContext
 *
 */
class HttpContext  implements IHttpContext
{
	
	/**
	 * This is variable Request description
	 *
	 * @var mixed 
	 *
	 */
	public $Request;
	
	/**
	* This is variable Response description
	*
	* @var mixed 
	*
	*/
	public $Response;

	/**
	 * This is variable Session description
	 *
	 * @var mixed 
	 *
	 */	
	public $Session;
	
	/**
	 * This is variable Handler description
	 *
	 * @var mixed 
	 *
	 */	
	public $ErrorHandler;
	
	/**
	 * This is method __construct
	 *
	 * @param HttpRequest $request This is a description
	 * @param HttpResponse $response This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function __construct(HttpRequest $request,HttpResponse $response)
	{
		$this->Init($request,$response);
		$request->Context = $this;
		$response->Context = $this;
		return $this;
	}
	
	/**
	 * This is method Init
	 *
	 * @param HttpRequest  [ $request ] This is a description
	 * @param HttpResponse  [ $response  ]This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function Init(HttpRequest $request,HttpResponse $response)
	{
		$this->Request  = $request;
		$this->Response = $response;
		$this->Session	= \Application::$Instance->Session;
		$this->Request->Context = $this;
		$this->Response->Context = $this; 
		return $this;
	}
	
	/**
	 * This is method ErrorHandler
	 *
	 * @param mixed $Handler This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function ErrorHandler($Handler = null)
	{
		$this->ErrorHandler = $Handler;
		return $this;
	}
	
	
	
	/*	public function __get($key)
		{
			switch($key)
			{
				case "ContentType":
					return	$this->Request->{$key};
					break;
				case "Session":
					return $this->Session->{$key};
					break;
			}
			
		}*/
	
}

?>