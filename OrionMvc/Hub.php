<?php
namespace OrionMvc;




abstract class Hub extends HubContext implements IHub{
	
	
	
	function __construct(){}
	
	abstract public function OnConnect();
	
	abstract public function OnDisconnect();
	
	
	
}

abstract class HubContext extends \ArrayObject{
	
	function OnConnected()
	{
			
		$this->OnConnected();
	}
	
	
	function OnDisconnected()
	{
		
		$this->OnDisconnected();
		
	}
	
	
	
}




interface IHub{
	
	public function OnConnect();
	
	public function OnDisconnect();
	
}




class HubFactory implements IHubFactory
{
			
	
	public function CreateHub(HttContext $Context)
	{
		
	}
	
	public function GetHub($Hub)
	{
		return  $Hub;
	}
}


interface IHubFactory
{
	
	public function CreateHub();
	
	
	/**
	 * This is method GetController
	 *
	 * @param mixed $Controller This is a description
	 * @return namespace;
	 * 
	 */	
	public function GetHub($Hub);
	
}
?>