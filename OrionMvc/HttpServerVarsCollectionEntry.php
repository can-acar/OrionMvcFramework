<?php

namespace OrionMvc;
/**
 * class iHttpServerVarsCollectionEntry
 *
 * Description for class iHttpServerVarsCollectionEntry
 *
 * @author:
*/
class HttpServerVarsCollectionEntry  {
	public $Name;
	public $Value;

	/**
	 * iHttpServerVarsCollectionEntry constructor
	 *
	 * @param 
	 */
	public function __construct($name,$value)
	{
		$this->Name = $name;
		$this->Value = $value;
	}
	
	public function GetValue(HttpRequest $request)
	{
		
	}
}

?>