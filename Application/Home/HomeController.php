<?php

/**
 * This is class Home
 *
 */
namespace Application\Home;
use OrionMvc;
use Model\UserLogonModels as UserLogon;


class HomeController extends OrionMvc\Controller {
	
	
	
	public function Index($id = null)
	{               
		$this->Message = "Orion Mvc Framework v1.0 ®".$id;
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
		$cookie->value = "can acar _";
		$cookie2 = new OrionMvc\HttpCookie();
		$cookie2->name = "userdata";
		$cookie2->value = "user data";
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
		//  $this->Response->Cookies->Reset();  
		//$this->Request->Cookies->AddCookie($cookie);
		//$this->Request->Cookies->AddCookie($cookie2);
			//$this->Response->Cookies->AddCookie($cookie,true);
		//$this->Request->SendCookie();
		
		//\Application::ConsoleLog($this);
		//$this->Response->Redirect("//www.google.com", $Code = 302, $Method = 'location');

		$_controller = OrionMvc\Router::$RouterCollection;//->GetController('default');
			//\Application::Debug($this->Response);
		
		
	}

	/**
	 * TODO: Eğer http post yapıyor ve form post ise  method parametreleri  belirtilim post  parametreleriyle eşleşip handle edilecek 
	 * 
	 */


	public function About()
	{
			$this->ViewName = "Index";
			$this->Message = "About";
	}

	#HttpPost#
	#Form#
	public function ContactFormPost()
	{

	}
	
    #HttpPost#
	public function TestMethod($a,$b)
	{
		
		
	}

	#HttpGet#
	public function Query($query)
	{

	}
	
	public function ActionExecuted(array $Context=null)
	{
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
