<?php

/**
 * This is class Home
 *
 */
namespace Application\Home;
use OrionMvc;
use Model\UserLogonModels as UserLogon;


class HomeController extends OrionMvc\Controller {
	
	
	
	public function Index()
	{		
        $this->Message = "Orion Mvc Framework v1.0 ®";
		//$UserLogon = new UserLogon\UserLogonModel();
		//$db = new OrionMvc\Database();
		//$this->Session->{"Test"} = "test session";
		//$this->Session->{"TextMessage"} = "text message";
		//$this->deneme;
		//var_dump(this);
		//$this->Response->Cookies->Add('deneme','test','1200','/','localhost');
		//$this->Response->Cookies->Add('deneme2','test2','1200','/','localhost');
		//$cookie = $this->Response->Cookies;
		//$this->Request->Headers->ClearInternal();
		//$this->Request->ServerVariables->AddStatic("sdfsdf","sfsfd");
		//$this->Request->Headers->Add('user-agent','sdfsdf');
		// $this->Request->Send();
		$cookie = new OrionMvc\HttpCookie();
		$cookie->name = "username";
		$cookie->value = "can_acar3";
		//  $this->Response->Cookies->Add($cookie);
		//$this->Request->SendRequest();
		//\Application::ConsoleLog($this->Request);
		//$this->Request->Send();
		//var_dump($cookie);
		//var_dump($cookie->AllKeys);
		//
		//
		//trigger_error("Warning Mesajı",E_ALL);
		
		//trigger_error("Notice Mesajı",E_NOTICE);
		
		//trigger_error("User Error mesajı felan", E_USER_NOTICE);
		//trigger_error("Insufficient arguments", E_USER_ERROR);
      //  $this->Request->Cookies->Reset();
     //   $this->Response->Cookies->Reset();  
		$this->Request->AddResponseCookie($cookie);
        $this->Response->Cookies->AddCookie($cookie,true);

		$this->Response->Send();
        
		\Application::ConsoleLog($this->Request->Cookies);
        
		
		//\Application::Debug($this);
		
		
	}
	
    #HttpPost#
	public function TestMethod($a,$b)
	{
		
		
	}
	
	public function ActionExecuted(array $Context=null)
	{
		//var_dump($Context);
		$this->Message = "Action Executed";	
	}
	
    #HttpPost#
	public function ActionExecuting()
	{
		$this->Message = "Action Executing";
	}
	
    #HttpGet#
	#JsonResult#
	public function Sesstest()
	{
		print_r( $this->Session);
	}
	
	
	#HttpPost#
	#JsonResult#
	public function Jsontest()
	{
		$this->json = true;
		
		return new Json($this);
	}
	
}
?>