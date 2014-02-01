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
    /**
     * Summary of HttpCookieCollection
     * @param OrionMvc\HttpCookieCollection $c 
     * @param mixed $readOnly 
     * @return mixed
     */
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

   /**
    * Summary of Add
    * @param OrionMvc\HttpCookie $cookie 
    */
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
    /**
     * Summary of AddCookie
     * @param OrionMvc\HttpCookie $cookie 
     * @param mixed $appand 
     */
    public function AddCookie(HttpCookie $cookie,$appand = false)
    {
        $this->_All = null;
        $this->_AllKeys = null;
        if($appand)
        {
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
    /**
     * Summary of Clear
     */
    public function Clear()
    {
        $this->Reset();
    }
    /**
     * Summary of Get
     * @param mixed $name 
     * @return mixed
     */
    public function Get( $name )
    {
        $cookie = $this[ $name ];
        $this->AddCookie($cookie);
        return $cookie;
    }
    /**
     * Summary of GetOffset
     * @param OrionMvc\int $index 
     * @return mixed
     */
    public function GetOffset(int $index)
    {
        return $this->offsetGet($index);    
    }
    /**
     * Summary of Remove
     * @param mixed $name 
     */
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
    /**
     * Summary of RemoveCookie
     * @param mixed $name 
     */
    public function RemoveCookie($name)
    {
        $this->_All = null;
        $this->_AllKeys = null;
        $this->BaseRemove($name);

    }
    /**
     * Summary of Reset
     */
    public function Reset()
    {
        $this->_All = null;
        
        $this->_AllKeys = null;
        
        unset($_COOKIE);
        
        unset($this);
        
        $this->BaseClear();
       
    }
    /**
     * Summary of Set
     * @param OrionMvc\HttpCookie $cookie 
     */
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
    
    /**
     * Summary of __toString
     * @return mixed
     */
    public function __toString()
    {
        return "OrionMVC.HttpCookieCollection";
    }
    
    /**
     * Summary of __callStatic
     * @param mixed $obj 
     * @param mixed $arguments 
     */
    public static function __callStatic($obj, $arguments)
    {
        self::HttpCookieCollection($arguments[0],$arguments[1]);
       
    }
}   
