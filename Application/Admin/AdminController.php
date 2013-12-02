<?php
namespace Application\Admin;
use OrionMvc;

class AdminController extends \OrionMvc\Controller
{
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
		
        //var_dump($cookie);
        //var_dump($cookie->AllKeys);
        //
        //
		$this->Message = ($this->Request->Url);
    }
}