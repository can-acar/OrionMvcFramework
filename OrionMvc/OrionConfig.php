<?php
namespace OrionMvc;

use Configration;
/**
 * class OrionConfig
 *
 * Description for class OrionConfig
 *
 * @author:
*/
class OrionConfig  extends \ArrayObject  implements IOrionConfig{

	protected $Config;

	/**
	 * OrionConfig constructor
	 *
	 * @param 
	 */
	public function __construct(Array $Config = null)
	{
		
		$this->SetFlags(\ArrayObject::ARRAY_AS_PROPS);
		
		foreach($Config as $Key => $Value)
		{
			if(is_array($Value))
			{
				$Value = new static($Value);
				
			}
			
			$this->offsetSet($Key,$Value);
		}
	}
	
	public function __get($Key)
	{
		
		return $this->offsetGet($Key);
		
	}
	
	public function __set($Key,$Value)
	{
		$this->offsetSet($Key,$Value);
	}
	
	public function __ToString()
	{
		return 'Array';
	}
	
	
}

interface IOrionConfig
{
	
}

?>