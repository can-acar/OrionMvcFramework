<?php
namespace OrionMvc\Exception;
use OrionMvc;
/**
 * class OrionControllerActionException
 *
 * Description for class OrionControllerActionException
 *
 * @author:
*/

class OrionControllerActionException extends \Exception {

	/**
	 * OrionControllerActionException constructor
	 *
	 * @param 
	 */
	public function __construct($Controller,	$action,	OrionMvc\HttpContext $context) {
		
		
		$context->Request->Headers->Add("HTTP/1.0 404 Not Found",404);
		$context->Request->Send();	
		
		$this->code = 404;
		
		$this->message =" {$action} action was not found in {$Controller} controller ";
	
	}
}

?>