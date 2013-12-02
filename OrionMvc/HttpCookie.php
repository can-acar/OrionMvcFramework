<?php
namespace OrionMvc;

/**
 * HttpCookie
 * 
 * @package Orion Mvc Framework
 * @author can acar
 * @copyright 2013
 * @version 
 * @access public
 */
class HttpCookie 
{
    public $name;
    
    public $value;
    
    public $domain;
    
    public $hostonly;
    
    public $path;
    
    public $expires;
    
    public $secure;
    
    public $FromHeader = false;
    
    public $Added = false;
    
    public $Changed = false;
    
    /**
     * HttpCookie::__construct()
     * 
     * @return
     */
    public function __construct($Cookie=null)
    {
        if(!is_object($Cookie))
        {	
            $this->name = $Cookie;
        }else
        {
            $this->name = $Cookie->name;
            $this->value = $Cookie->value;
            $this->domain = $Cookie->domain;
            $this->hostonly = $Cookie->hostonly;
            $this->path	    = $Cookie->path;
            $this->expires  = $Cookie->expires;
            $this->secure   = $Cookie->secure;
        }
        
  	  return $this;
    }
	  
    public function __set($name,$value)
    {
        $this->{$name}=$value;
    }
    
    public function __get($name)
    {
        return $this->{$name};
    }
    
}



