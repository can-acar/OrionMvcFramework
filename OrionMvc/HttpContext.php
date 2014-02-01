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
	 * Summary of __construct
	 * @param OrionMvc\HttpRequest $request 
	 * @param OrionMvc\HttpResponse $response 
	 * @param mixed $Session 
	 * @return mixed
	 */
	public function __construct(HttpRequest $request,HttpResponse $response,$Session = null)
	{
		$this->Init($request,$response);
		$request->Context = $this;
		$response->Context = $this;
		$this->Session = $Session;
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
		$this->Request->Context = $this;
		$this->Response->Context = $this; 
		return $this;
	}
	

	
}

?>