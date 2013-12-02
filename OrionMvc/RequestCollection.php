<?php
namespace OrionMvc;
/**
 * class RequestCollection
 *
 * Description for class RequestCollection
 *
 * @author:
*/
class RequestCollection  implements IRquestCollection{

	protected $Collection = array();
	
	public function __set($Key,$Value)
	{
		$this->Collection[$Key]= $Value;
	}
	
	public function __get($Key)
	{
		try{
			
			
			if(array_key_exists($Key,$this->Collection))
			{
				return $this->Collection[$Key];	
			}
			
		}catch (Exception $e)
		{
			throw OrionException:: ExceptionHandler($e);
		}
		return NULL;
	}
}

interface IRquestCollection
{
	public function __set($Key,$Value);
	
	public function __get($Key);
}

?>