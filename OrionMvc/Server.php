<?php
namespace OrionMvc;
/**
 * class Server
 *
 * Description for class Server
 *
 * @author:
*/

class Server  {

	public $Host;	
	
	/**
	 * Server constructor
	 *
	 * @param 
	 */
	public function __construct() {
		
		$Server = (object)$_SERVER;
		
		$this->Host = $Server->HTTP_HOST;
		
		$this->Connection = $this->HTTP_CONNECTION;
		
		$this->CacheControl = $this->HTTP_CACHE_CONTROL;
		
		
		
		
		//array_walk(new\ArrayIterator($_SERVER),array($this,'Extract'));
	}
	
	public function Extract($value,$key)
	{
		
		//var_dump($key.":".$value);
	}
	
	
}

?>