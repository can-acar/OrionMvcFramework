<?php
namespace OrionMvc;

class HttpCookieCollection extends NameObjectCollection
{
    protected   $_AllKeys;
    private     $_All;
    private $Response;

	
    const HttpCookieCollection = __CLASS__;
    
    function __construct(HttpResponse $response = null ,$readOnly)
    {

        $this->Response = $response;
        $this->IsReadOnly = $readOnly;
        
       
    }
    
    function HttpCookieCollection(HttpCookieCollection $c ,$readOnly)
    {

        for($i = 0;$i<$this->count();$i++)
        {
            $name = $c->BaseGetKey($i);
            $obj2 = $c->BaseGet($i);
            $this->BaseAdd($name,$obj2);
        }

        $this->IsReadOnly = $readOnly;
        parent::__construct($this);
        return $this;
    }

    
   public function Add(HttpCookie $cookie)
    {
        if($this->Response !=null)
        {
            $this->Response->BeforeCookieCollection();
        }
        $this->AddCookie($cookie , true);
        if($this->Response !=null)
        {
            $this->Response->OnCookieAdd($cookie);
        }
        
    }
    
    public function AddCookie(HttpCookie $cookie,$appand = false)
    {
        $this->_All = null;
        $this->_AllKeys = null;
        if($appand){
            if(!$cookie->FromHeader)
            {
                $cookie->Added  =   true;
            }
            $this->BaseAdd($cookie->name,$cookie);
            
        }else{
            if($this->BaseGet($cookie->name) !=null)
            {
                $cookie->Changed = true;
            }
            $this->BaseSet($cookie->name,$cookie);
        }
        
    }
    
    public function Clear()
    {
        $this->Reset();
    }
    
    public function Get( $name )
    {
        $cookie = $this[ $name ];
        $this->AddCookie($cookie);
        return $cookie;
    }
    
    public function GetOffset(int $index)
    {
        return $this->offsetGet($index);    
    }
    
    public function Remove($name)
    {
        if($this->Response !=null)
        {
            $this->Response->BeforeCookieCollection();
        }
        $this->RemoveCookies($name);
        if($this->Response !=null)
        {
            $this->Response->OnCookieCollectionChange();
        }
    }
    
    public function RemoveCookie($name)
    {
        $this->_All = null;
        $this->_AllKeys = null;
        $this->BaseRemove($name);

    }
    
    public function Reset()
    {
        $this->_All = null;
        
        $this->_AllKeys = null;
        
        unset($_COOKIE);
        
        unset($this);
        
        $this->BaseClear();
       
    }
    
    public function Set(HttpCookie $cookie)
    {
        if($this->Response !=null)
        {
            $this->Response->BeforeCookieCollectionChange();
        }
        $this->AddCookie($cookie,false);
        if($this->Response !=null)
        {
            $this->Response->OnCookieCollectionChange();
        }
    }
    
    public function __toString()
    {
        return "OrionMVC.HttpCookieCollection";
    }

   
    
    public static function __callStatic($obj, $arguments)
    {
        self::HttpCookieCollection($arguments[0],$arguments[1]);
       
    }
}   
