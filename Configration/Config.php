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
	public function __construct()
	{
		$List = array(
			"Router" => new RouterConfig(),
			"Site"	 => new BaseConfig(),
			"Cache"  => new CacheConfig()
				
		);
		
		$Config = new OrionMvc\OrionConfig($List);
		
		//var_dump($Config->Site);
		
	}
}




?>