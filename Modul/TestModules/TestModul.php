<?php

namespace TestModules;
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
class TestModul extends Module {

	/**
	 * TestModul constructor
	 *
	 * @param 
	 */
	function TestModul() {

	}
	
	public function Register()
	{
		$this->ModuleName["TestModul"] = $this;
		
	}
	
	
}

?>