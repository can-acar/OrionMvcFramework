<?php

namespace OrionMvc\Exception;
use OrionMvc;

class OrionControllerException extends Exception
{


	public function __construct($controller,OrionMvc\HttpContext $context)
	{

		$this->message ="{$controller} Controller  Not Found!";
		
		$this->code = 404;
		
		header("Page Not Found",404);
		
		$context->Request->Headers->Add("Page Not Found",404);
			
		
	}
}
?>