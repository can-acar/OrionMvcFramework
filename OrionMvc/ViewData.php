<?php
namespace OrionMvc{
	

/**
 * class ViewData
 *
 * Description for class ViewData
 *
 * @author:
*/
class ViewData extends  \ArrayObject implements IViewData 
{

	private static $DataCollection = array();

	public	function __construct()
	{
		parent::__construct($this,\ArrayObject::ARRAY_AS_PROPS);
		return $this;
	}
	
	public function __get($Key)
	{
		switch($Key){
			case 'Cookies':
			case 'Session':
				return null;
			break;
		}
		return	self::$DataCollection[$Key];
	}
	
	
	public function __set($Key,$Value)
	{
		self::$DataCollection[$Key]= $Value;
	}
	
	
	public function __isset($Key)
	{
		  
		return isset(self::$DataCollection[$Key]);
		
	}
	
	
	public static function Set($key,$value)
	{
		self::$DataCollection[$key]= $value;
	}
	
	
	public static function Get($key)
	{
		return self::$DataCollection[$key];
	}
	
	
	public function SetData($key,$value)
	{
		self::$DataCollection[$key]= $value;
	}
	
	
	public function GetData()
	{
		return self::$DataCollection;
	}
}

	
	interface IViewData
	{
		public static function Set($key,$value);
		
		public static function Get($key);
		
		public function SetData($key,$value);
		
		public function GetData();
	}
}
?>