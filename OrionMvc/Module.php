<?php
namespace	OrionMvc;
/**
 * class Modul
 *
 * Description for class Modul
 *
 * @author:
*/
class Module extends EventListener implements IModule {

	public $ModuleName = null;
	private $Module = array();
	private $application;
	/**
	 * Modul constructor
	 *
	 * @param 
	 */
	function __construct($application) {
	
		$this->application = $application;
		
		return $this;
	}
	
	public function onInit()
	{
		
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
	public  function Register($ModuleName,$ActionFilter,array $Params = null)
	{
		$__class = sprintf("Modul\\%s\\%s",$ModuleName,'TestModul');
		
		$__class = new \ReflectionClass($__class);
		
		$modul = 	$__class->newInstance($Params);
		
		//\Application::ConsoleLog($__func);
		
		//\Application::ConsoleLog($namespace);
		
		$this->application->Event->modul->bind($modul,"{$ActionFilter}");
		
		//\Application::ConsoleLog($this);
	}
	

}

?>