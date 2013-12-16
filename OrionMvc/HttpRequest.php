<?php

namespace OrionMvc{

/**
 * HttpRequest
 * 
 * @package Orion Mvc Framework
 * @author can acar
 * @copyright 2013
 * @version 1.0
 * @access public
 */
class HttpRequest  implements IHttpRequest
{
	
	/**
	 * Gets a string array of client-supported MIME accept types.
	 *
	 * @var $AcceptTypes
	 *
	 */
	public $AcceptTypes;
	/**
	 * Gets the php application's virtual application root path on the server.
	 *
	 * @var mixed 
	 *
	 */	
	public $ApplicationPath;
	/**
	 * Gets or sets information about the requesting client's browser capabilities.
	 *
	 * @var mixed 
	 *
	 */
	public $Browser;
	/**
	 * This is variable ContentEncoding description
	 *
	 * @var mixed 
	 *
	 */	
	public $ContentEncoding;
	/**
	 * This is variable ContentLength description
	 *
	 * @var mixed 
	 *
	 */	
	public $ContentLength;
	/**
	 * This is variable ContentType description
	 *
	 * @var mixed 
	 *
	 */	
	public $ContentType;
	/**
	 * This is variable Context description
	 *
	 * @var mixed 
	 *
	 */	
	public $Context;	
	/**
	 * Gets a collection of cookies sent by the client.
	 * 
	 * @example $this->Request->Cookies["name"] return cookie;
	 * 
	 * @example $this->Request->Cookies->GetOffset($index) index integer;
	 * 
	 * @type HttpCookieCollection;
	 * 
	 * @var Cookie;
	 *
	 */	
	public $Cookies; //= HttpCookieCollection::HttpCookieCollection;
	/**
	 * This is variable CurrentExecutionFilePath description
	 *
	 * @var mixed 
	 *
	 */	
	public $CurrentExecutionFilePath;
	/**
	 * This is variable FilePath description
	 *
	 * @var mixed 
	 *
	 */	
	public $FilePath;
	/**
	 * This is variable Files description
	 *
	 * @var mixed 
	 *
	 */	
	public $Files;
	/**
	 * This is variable Filter description
	 *
	 * @var mixed 
	 *
	 */	
	public $Filter;
	/**
	 * This is variable Form description
	 *
	 * @var mixed 
	 *
	 */	
	public $Form;
	/**
	 * This is variable Headers description
	 *
	 * @var mixed 
	 *
	 */	
	public $Headers;
	/**
	 * This is variable HttpMethod description
	 *
	 * @var mixed 
	 *
	 */	
	public $HttpMethod;
	/**
	 * This is variable Item description
	 *
	 * @var mixed 
	 *
	 */	
	public $Item;
	/**
	 * This is variable isAjax description
	 *
	 * @var mixed 
	 *
	 */	
	public $isAjax=false;
	
	/**
	 * This is variable Params description
	 *
	 * @var mixed 
	 *
	 */	
	public $Params;
	/**
	 * This is variable Path description
	 *
	 * @var mixed 
	 *
	 */	
	public $Path;
	/**
	 * This is variable PhysicalApplicationPath description
	 *
	 * @var mixed 
	 *
	 */	
	public $PhysicalApplicationPath;
	/**
	 * This is variable PhysicalPath description
	 *
	 * @var mixed 
	 *
	 */	
	public $PhysicalPath;
	/**
	 * This is variable QueryString description
	 *
	 * @var mixed 
	 *
	 */	
	public $QueryString = array();
	/**
	 * This is variable RawUrl description
	 *
	 * @var mixed 
	 *
	 */	
	public $RawUrl;
	/**
	 * This is variable Request description
	 *
	 * @var mixed 
	 *
	 */	
	public $Request;
	/**
	 * This is variable RquestType description
	 *
	 * @var mixed 
	 *
	 */	
	public $RequestType;
	/**
	 * This is variable ServerVariables description
	 *
	 * @var mixed 
	 *
	 */	
	public $ServerVariables;
	/**
	 * This is variable Url description
	 *
	 * @var mixed 
	 *
	 */	
	public $Url;
	/**
	 * This is variable UrlReferrer description
	 *
	 * @var mixed 
	 *
	 */	
	public $UrlReferrer;
	/**
	 * This is variable UserAgent description
	 *
	 * @var mixed 
	 *
	 */	
	public $UserAgent;
	/**
	 * This is variable UserHostAdress description
	 *
	 * @var mixed 
	 *
	 */	
	public $UserHostAdress;
	/**
	 * This is variable UserHostName description
	 *
	 * @var mixed 
	 *
	 */	
	public $UserHostName;
	/**
	 * This is variable UserLanguages description
	 *
	 * @var mixed 
	 *
	 */	
	public $UserLanguages;
	
	
	public $Contents;
    
    
    public $IP;
	

	
	public $_wr;
	
	
	/**
	 * HttpRequest::__construct()
	 * 
	 * @return
	 */
	public function __construct($uri=null, $method = null,$queryString = null,$Contents = null){
		
		$this->GetServerVars();
		
		$this->EnsureHeaders();
		
		$this->EnsureCookies();
		
		$this->AcceptTypes  =   null;
		$this->Contents     =   null;
		$this->HttpMethod	=   $method;
		$this->Url			=	new Uri($uri);
		$this->ContentLength = -1;
		$this->_wr          = null;
		//$this->QueryString  = new HttpValueCollection($queryString);
		
		
		return $this;
	}
	
	
	

	
	/**
	 * HttpRequest::GetParams()
	 * 
	 * @return
	 */
	private function GetParams()
	{
		if($this->Params == NULL)
		{
			$this->Params = new HttpValueCollection();
			$this->FillInParamsCollection();
		}
		return $this->Params;
	}
	
	
	function FillInParamsCollection()
	{
		$this->Params->Add($this->QueryString);
		$this->Params->Add($this->Form);
		$this->Params->Add($this->Cookies);
		$this->Params->Add($this->ServerVariables);
		
	}
	
	public function FillInServerVariablesCollection()
	{
		if($this->_wr !=null)
		{
			foreach($_SERVER  as $name => $value)
			{
				//\Application::ConsoleLog($name."=".$value);
				switch($name)
				{
					case 'REDIRECT_STATUS':
						break;
					case 'HTTP_HOST':
						$this->UserHostName = $value;
						break;
					case 'HTTP_CONNECTION':
						break;
					case 'HTTP_CACHE_CONTROL':
						break;
					case 'HTTP_ACCEPT':
						$this->AcceptTypes = $value;
						
						break;
					case 'HTTP_USER_AGENT':
						$this->UserAgent = $value;
						break;
                    case 'HTTP_REFERER':
                        $this->UserHostAdress = $value;
                        break;
                    case 'HTTP_ACCEPT_ENCODING':
                        $this->ContentEncoding = $value;
                        break;
                    case 'HTTP_ACCEPT_LANGUAGE':
                        $this->UserLanguages = $value;
                        break;
                    case 'PATH':
                        $value = null;
                        break;
                    case 'SERVER_ADDR':
                        $this->IP = $value;
                        break;
                    case 'SERVER_PORT':
                        break;
                    case 'DOCUMENT_ROOT':
                        $this->ApplicationPath = $value;
                    break;
                    case 'REQUEST_METHOD':
                        $this->HttpMethod = $value;
                        break;
                    case 'QUERY_STRING':
                        $this->QueryString = $value;
                        $this->QueryStringParams = null;
                        break;
                    case 'REQUEST_URI':
                        $this->Path =	filter_var( $value, FILTER_SANITIZE_STRING ,FILTER_FLAG_STRIP_HIGH);
                        break;
                    
				}
				$this->AddServerVariableToCollection(strtolower( $name ),$value);
			}
		}
	}
	
	
	
	public function FillInCookiesCollection(HttpCookieCollection $CookieCollection,$includeResponse)
	{
		if($this->_wr !=null)
		{
		
			$_knowHeaderRequest = $this->Headers;
			
			if(isset( $_knowHeaderRequest["cookie"] ))
			{
				if(count($_COOKIE ) == 1)
				{
					$Cookie2 = $this->CreateCookieFromString( $_knowHeaderRequest->cookie,true);  
					
					if(count($_COOKIE)==1)
					{
						
						$CookieCollection->AddCookie($Cookie2,true);
						
					}
				}
				
				if(count($_COOKIE ) > 1)
				{
					foreach($_COOKIE as $Key => $Value)
					{
                        $Cookie = new HttpCookie;
						$Cookie->FromHeader=false;
						
						switch($Key)
						{
							case "DOMAIN":
								$Cookie->domain = $Value;
								break;
							case "NAME":
								$Cookie->name = $Value;
								break;
							case "PATH":
								$Cookie->path = $Value;
								break;
							default:
								$Cookie->name = $Key;
								$Cookie->value = $Value;
								break;
						}
						
						$CookieCollection->AddCookie($Cookie,true);
						
					}
				}
			}
        }
	}
	
	public function FillInHeadersCollection()
	{
		if($this->_wr !=null)
		{
			if(!is_null($this->Headers))
			{
				if(function_exists('apache_request_headers')){
					
					$_header =	 array_change_key_case(apache_request_headers(), CASE_LOWER);
					foreach($_header as $key => $value)
					{
						$this->Headers->Add(strtolower($key) , $value,false);
					}	
					
				}else{
					foreach($_SERVER as $k => $v){
						if(strncmp($k, 'HTTP_', 5) == 0){
							$k = substr($k, 5);
						}elseif(strncmp($k, 'CONTENT_', 8)){
							continue;
						}
						$this->Headers->Add( strtr(strtolower($k), '_', '-') , $v,false);
						
					}
				}
			}
			return $this->Headers;
			
		}
	}
	

		
	/**
	 * HttpRequest::GetServerVariables()
	 * 
	 * @return
	 */
	private function GetServerVars()
	{
		if($this->ServerVariables == null)
		{
			$this->ServerVariables = new HttpServerVarsCollection($this);
		}
		if($this->_wr !=null)
		{
			$this->FillInServerVariablesCollection();
		}
		return $this->ServerVariables;
		
	}
	
	/**
	 * HttpRequest::ParseValueHeaders()
	 * 
	 * @param mixed $string
	 * @return
	 */
	private function ParseValueHeaders($string)
	{
		if(is_null($string))
			return NULL;
		$_header = $this->GetHeaders();
		
		return $_header[$string];
		
	}
	
	private function EnsureHeaders()
	{
		if($this->Headers == null)
		{
			$this->Headers = new HttpHeaderCollection($this,null);
		}
		if($this->_wr !=null)
		{
			$this->FillInHeadersCollection();
		}
		return $this->Headers;
		
	}
	
	private function EnsureCookies()
	{
		if($this->Cookies == null)
		{              
			$this->Cookies  = new HttpCookieCollection(null,false);
		}
		if($this->_wr != null)
		{
			$this->FillInCookiesCollection($this->Cookies,true);
			
		}
		
		return $this->Cookies;
	}
	
	public function AddResponseCookie(HttpCookie $cookie)
	{
		if($this->Cookies !=NULL)
		{
			$this->Cookies->AddCookie($cookie,true);
		}
		if($this->Params != NULL)
		{
			$this->Params->MakeReadWrite();
			$this->Params->Add($cookie->name,$cookie->value);
			$this->Params->MakeReadOnly();

		}
	}
    
	public function AddServerVariableToCollection($name,$value)
	{
		if($value == null)
		{
			$value = "";
		}
		$this->ServerVariables->AddStatic($name,$value);
	}

	public function CreateCookieFromString($string)
	{
		$cookie = new HttpCookie();
		
		
		preg_match('|([^=]*?)=([^;]*)|',$string,$_cookie);
		$cookie->name  = trim($_cookie[1]);
		$cookie->value = trim($_cookie[2]);
		
		if(preg_match('|domain=([^;]*)|i',$string,$domain)){
			$domain = $domain[1];
			$hostonly = false;
		}else{
			$domain = $this->UserHostName;
			$hostonly = true;
		}
		
		$cookie->domain = $domain;
		$cookie->hostonly = $hostonly;
		
		if(preg_match('|path=([^;]*)|i',$string,$path)){
			$path = $path[1];
		}else{
			$path = $this->Path;
			$path = substr($path,0,strrpos($path,'/'));
			if(empty($path))$path = '/';
		}
		
		$cookie->path=$path;
		
		if(preg_match('|expires=([^;]*)|i',$string,$expires)){
			$expires = $expires[1];

			
			if(preg_match('|\d{2}-[a-z]{3,4}-(\d*)|i',$expires,$match)){
				if($match[1] >= 38 && $match[1] < 100) $expires = '2038-01-01';
			}
		}else{
			$expires = '2038-01-18';
		}
		
		$cookie->expires = strtotime($expires);
		
		
		return $cookie;
		
	}
	

	/**
	 * HttpRequest::Async()
	 * 
	 * @source http://www.phpepe.com/2011/05/php-asynchronous-background-request.html
	 * @param string $Url
	 * @param array $params
	 * @return void
	 */
	
	public function Async(string $Url,array $params = NULL){
		$post_params = array(); 
		foreach($params as $key => &$val){
			if(is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);
		
		$parts=parse_url($url);
		
		$fp = fsockopen($parts['host'],
			isset($parts['port'])?$parts['port']:80,
			$errno, $errstr, 30);
		
		$out = "POST ".$parts['path']." HTTP/1.1\r\n";
		$out.= "Host: ".$parts['host']."\r\n";
		$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out.= "Content-Length: ".strlen($post_string)."\r\n";
		$out.= "Connection: Close\r\n\r\n";
		if(isset($post_string)) $out.= $post_string;
		
		fwrite($fp, $out);
		fclose($fp);
		
		
	}
	
	public function ParseQueryString($Query = null){
		$params = array();
		if(is_null($Query)){
			return array();
		}
		
		$pairs = explode('&', $Query);

		foreach($pairs as $pair){
			list($name, $value) = explode('=', $pair, 2);
			$this->QueryStringParams[rawurldecode($name)]=rawurldecode($value);
			$this->{rawurldecode($name)}=rawurldecode($value);
		}
		
		return  $this->QueryStringParams;
	}
	
	public function SendRequest(){
		
		$context = stream_context_create(array
			(
					'http' => array(
						'method' => $this->HttpMethod,
						'header' => $this->Headers,
						'content' => http_build_query( $this->QueryString )
						)
					));
		
		$this->Contents =	 file_get_contents($this->Url, false, $context);
		return $this->Contents; 
	}
	
	public function GetContents($Resource = false)
	{
		if(false === $this->Contents || ( true === $Resource && null !== $this->Contents))
		{
			throw OrionException::Handler(new Exception\LogicException("getContent() can only be called once when using the resource return type."));
		}
		if(true === $Resource)
		{
			$this->Contents = false;
			
			return fopen('php://input','rb');
		}
		if(null === $this->Contents)
		{
			$this->Contents =  file_get_contents('php://input');
		}
		
		
		return $this->Contents;
	}
	
	public function Send()
	{

		$this->SendHeaders();
		$this->SendCookie();
		$this->SendBody();
	
		if (function_exists('fastcgi_finish_request')) {
			fastcgi_finish_request();
		} elseif ('cli' !== PHP_SAPI) {
			// ob_get_level() never returns 0 on some Windows configurations, so if
			// the level is the same two times in a row, the loop should be stopped.
			$previous = null;
			$obStatus = ob_get_status(1);
			while (($level = ob_get_level()) > 0 && $level !== $previous) {
				$previous = $level;
				if ($obStatus[$level - 1]) {
					if (version_compare(PHP_VERSION, '5.4', '>=')) {
						if (isset($obStatus[$level - 1]['flags']) && ($obStatus[$level - 1]['flags'] & PHP_OUTPUT_HANDLER_REMOVABLE)) {
							ob_end_flush();
						}
					} else {
						if (isset($obStatus[$level - 1]['del']) && $obStatus[$level - 1]['del']) {
							ob_end_flush();
						}
					}
				}
			}
			flush();
		}

		return $this;

		
		
	}
	
	public function SendHeaders()
	{
		if(headers_sent())
		{
			throw	OrionException::Handler(new ErrorException("Headers already sent! Tip: try ob_start() before calling send()]"));

		}
		
		if(!empty($this->Headers))
		{
			foreach($this->Headers as $key => $value)
			{
				header($key.':'.$value, true);
			}
		}
        return $this;
	}
	
	public function SendCookie()
	{
		if(headers_sent())
		{
			throw	OrionException::Handler(new ErrorException("Headers already sent! Tip: try ob_start() before calling send()]"));
		
		}
		
		if(!empty($this->Cookies))
		{
            
			foreach ($this->Cookies as $cookie)
			{
                           
                if($cookie instanceof HttpCookie){

				    setcookie($cookie->name, $cookie->value, $cookie->expires, $cookie->path, $cookie->domain, $cookie->secure, $cookie->hostonly);
			        
                }else
                {
                    $array = $cookie->getArrayCopy();
                    $_cookie = $array[1];

                    setcookie($_cookie->name, $_cookie->value, $_cookie->expires, $_cookie->path,$_cookie->domain, $_cookie->secure,$_cookie->hostonly);
                    
                }
            }
			
		}
        return $this;
		
	}
	
	public function SendBody()
	{
		echo (string)  $this->Contents;
        return $this;
	}
	
	public function ValidateHttpValueCollection(HttpValueCollection $collection)
	{
		
		$Count = $collection->Count();
		
		for($i=0;$i<$Count; $i++)
		{
			$str = $collection->GetKey($i);
			$str2 = $collection->Get($str);
			filter_var($str, FILTER_SANITIZE_STRING ,FILTER_FLAG_STRIP_HIGH);
			filter_var($str2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$collection->Add($str,$str2);
			
		}
		
		return $collection;
	}
	
	public function ValidateHttpCookieColletion(HttpCookieCollection $collection)
	{
		for($i = 0; $i<$collection->count();$i++)
		{
			$str = $collection->GetKey($i);
			$srt2 = $collection->Get($i);
            filter_var($str, FILTER_SANITIZE_STRING ,FILTER_FLAG_STRIP_HIGH);
			filter_var($str2, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$collection->Add($str,$str2);
		}
        return $collection;
	}
	
	
}
}
?>