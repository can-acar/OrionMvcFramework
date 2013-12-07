<?php

namespace OrionMvc\Exception;
use OrionMvc;

class OrionControllerException extends \Exception
{


	public function __construct($controller,OrionMvc\HttpContext $context)
	{

        $context->Request->Headers->Add("HTTP/1.0 404 Not Found",404);
		$context->Request->Send();	
        
		$this->message ="{$controller} Controller  Not Found!";
		
		$this->code = 404;
		
		
	}
}
?>