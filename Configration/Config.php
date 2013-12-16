<?php
namespace Configration;

use OrionMvc;
/**
 * class Config
 *
 * Description for class Config
 *
 * @author:
*/
class Config  {

	/**
	 * Config constructor
	 *
	 * @param 
	 */
	public function __construct(\Application $application)
	{
		$List = array(
			"Router" => new RouterConfig($application),
			"Site"	 => new BaseConfig($application),
			"Cache"  => new CacheConfig($application),
			"Module" => new ModuleConfig($application) 
				
		);
		
		$Config = new OrionMvc\OrionConfig($List);
		
		//var_dump($Config->Site);
		
	}
}




?>