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

class OrionControllerActionException extends Exception {

	/**
	 * OrionControllerActionException constructor
	 *
	 * @param 
	 */
	public function __construct($Controller,	$action,	OrionMvc\HttpContext $context) {
		
		header("Page Not Found",404);
		
		$this->code = 404;
		
		$this->message =" {$action} action was not found in {$Controller} controller ";
		
		
		//$context->Request->Headers->Add("Page Not Found",404);
		return $this;	
	}
}

?>