<?php
namespace OrionMvc;
/**
 * This is class Autoloader
 *
 */
class Autoloader 
{
	
	/**
	 * This is method __construct
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public	function __construct()
	{
		spl_autoload_register(array($this, 'Load'));

	}
	
	/**
	 * This is method Load
	 *
	 * @param mixed $className This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public static function Load($className)
	{
		try
		{
			if (class_exists($className, false))return true;

			$className = ltrim($className, '\\'); 
			$fileName  = ''; 

			if ($lastNsPos = strrpos($className, '\\')) 
				$className = substr($className, $lastNsPos + 1); 

			$fileName = \Application::FindFile($className,ABSPATH);
			
			if (file_exists($fileName)) 
			{
				require_once $fileName; 
				return true; 
			} 
			else return false; 

		}catch (\Exception $e) {
			
			throw OrionException::Handler(new Exception\ErrorException('File Not Found!'));
		}

	}
	
	
	
}
?>