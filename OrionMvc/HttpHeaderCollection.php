<?php
namespace OrionMvc;
/**
 * class HttpHeaderCollection
 *
 * Description for class HttpHeaderCollection
 *
 * @author:
*/
class HttpHeaderCollection extends HttpValueCollection
{

	private $Response;
	private $Request;
	//,HttpRequest $request =null,HttpResponse $response = null
	/**
	* HttpHeaderCollection construct();
	* 
	* @param HttpRequest $request
	* @param HttpResponse $response
	* 
	* @return
	*/
	function __construct(HttpRequest $request = null,HttpResponse $response = null) 
	{
		$this->Request = $request;
		$this->Response = $response;
		
        if(!is_null($request))
		    $request->Headers = $this;
        
        if(!is_null($response))
             $response->Headers = $this;
        
		return $this;
		
	}
	
	function HttpRequest(HttpRequest $request)
	{
		$this->Request = $request;
	}
	
	function HttpResponse(HttpResponse $response)
	{
		$this->Response = $response;
	}

	
	
	
	function Add($name,$value)
	{
		$this->SetHeader($name,$value,false);
	}
	
	function Set( $name,$value)
	{
		$this->SetHeader($name,$value,true);
	}
	
	function Clear()
	{
		throw  OrionException::Handler(new Exception\ErrorException("Http Header Collection Clear Error!."));
	}
	
	function ClearInternal()
	{
		if($this->Request == null)
		{
			throw OrionException::Handler(new Exception\ErrorException('Not Supported Exception'));
		}
		$this->Clear();
	}


	function Remove( $name)
	{
		if(is_null($name))
		{
			throw OrionException::Handler( new Exception\ErrorException("null argument exception :$name"));
		}
		parent::Remove($name);
		
		if($this->Request !=null)
		{
			$serverVariables = $this->Request->ServerVariables =  HttpServerVarsCollection;
		}
		else
		{
			
		}
		
	}	
	
	
	
	function SetHeader( $name, $value = null,  $replace = true )
	{

		if(is_array($name))
		{
			foreach($name as $k => $v)
			{
				if(is_string($k)){
					$this->SetHeader($k, $v, $replace);
				}else{
					$this->SetHeader($v, null, $replace);
				}
			}
		}else{
			
			if(null === $value && strpos($name, ':'))
			{
				list($name, $value) = array_map('trim', explode(':', $name, 2));
			}
			
			// Header names are case insensitive anyway
			$name = strtolower($name);
			if(null === $value){
				
				$this->Remove($name);

			}else{
				if(is_array($value)){
					$value = implode(', ', array_map('trim', $value));
				}elseif(is_string($value)){
					$value = trim($value);
				}
				if(!$this->Has($name) || $replace){
					$this[$name] =$value;
					//$this->Add($name,$value);
				}else{
					$this[$name] .= ', ' . $value;
					//$this->Add($name,",".$value);
				}
			}
		}

		return $this;
	}
	
	function Get($name)
	{
		return parent::Get($name);
	}
	
}


?>