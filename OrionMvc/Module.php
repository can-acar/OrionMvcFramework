<?php
namespace	OrionMvc;
/**
 * class Modul
 *
 * Description for class Modul
 *
 * @author:
*/
abstract class Module extends SplObserver  implements IModule {

	public $ModuleName = null;
	
	/**
	 * Modul constructor
	 *
	 * @param 
	 */
	function Modul() {

	}
	/**
	 * This is method Register
	 *
	 * @param mixed $ModuleName This is a description
	 * @param mixed $ActionFilter This is a description
	 * @param mixed $Params This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function Register($ModuleName,$ActionFilter,$Params=array())
	{
		
	}
	
	public function Run()
	{
		
	}
}

?>