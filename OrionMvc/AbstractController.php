<?php
namespace OrionMvc;

abstract class AbstractController extends ActionFilter
{

	public $Context;

	public $ViewData;

	public $Name;

	public $Request;
	
	public $Response;
	
	public $Session;

	public $ViewName = null;
	
	public function __set($key,$value)
	{		
		$this->ViewData->SetData($key,$value);
	}
	
	public function __get($key)
	{
		return $this->ViewData->Get($key);

	}
	
}
?>