<?php
namespace Configration;
use OrionMvc;

class ModuleConfig{
	
	public function __construct($application)
	{
		
		$Module = new OrionMvc\Module($application);
		
		$Module->Register('Test' ,'onActionResult');
		
	  //	\Application::ConsoleLog($application);
	}
}



?>