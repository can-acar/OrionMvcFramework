<?php

namespace Modul\Test;
use OrionMvc;
use OrionMvc\Helper;
use OrionMvc\Extend;
/**
 * class TestModul
 *
 * Description for class TestModul
 *
 * @author:
*/
class TestModul extends OrionMvc\Module {
	
	

	/**
	 * TestModul constructor
	 *
	 * @param 
	 */
	function __constructor()
	{
		$thi->ModuleName= "TestModul";
		//parent::__constructor();
		
		$this->Register("TestModul","orion.modul.onInit.TestModul");
		\Application::ConsoleLog(func_get_args());
	}
	
	public function onActionResult($Params = null)
	{
		\Application::ConsoleLog(func_get_args());
	}
	
	
	
}

?>