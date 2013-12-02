<?php
namespace OrionMvc;

class ViewModel
{
	
	protected $Model;
	
	public function __construct(IModel $Model)
	{
			$this->Model = $Model;
	}
	
	public function __get()
	{
		
	}
	
	public  function __call($Method,array $Args = null)
	{
		
	}
	
	public static function __callStatic($Method, ,array $Args = null)
	{
		
	}
}

?>