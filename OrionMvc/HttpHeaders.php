<?php
namespace OrionMvc;


class HttpHeaders extends \ArrayObject
{


	  public  function __construct($array = array()) {
	    parent::__construct(array_merge($this,$array), \ArrayObject::ARRAY_AS_PROPS);
	  }


	  public  function Add($name,$value)
	  {
			if(is_null($name))
			{
				$this->offSetSet(null,$value);
			}else
			{
				$this->offSetSet($name,$value);
			}
	  }
	  
	  public function Has($name)
	  {
	  	return $this->offsetExists($name);
	  }
	  
	  public function Remove($name)
	  {
	  	$this->offsetUnset($name);
	  }
	  
	  public function Get($name)
	  {
	  	return $this->offsetGet($name);
	  }
	  
	  public function __set($Name,$Value)
	  {
		
			if(is_null($Name))
			{
				$this->offsetSet(null,$Value);
			}else
			{
				$this->offsetSet($Name,$Value);
			}
	  }
	
	public function __get($name)
	{
		return $this->offsetGet($name);
	}
	  
	public function __ToString()
	{
	  	return "Array";
	}
	
	  
}
?>