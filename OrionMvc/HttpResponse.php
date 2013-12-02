<?php
namespace OrionMvc;
/**
 * class HttpResponse
 *
 * Description for class HttpResponse
 *
 * @author:
*/
class HttpResponse {
	
	
	
	/**
	 * This is variable Code description
	 *
	 * @var mixed 
	 *
	 */
	private $Code;
	/**
	 * This is variable Error description
	 *
	 * @var mixed 
	 *
	 */	
	private $Error;
	/**
	 * This is variable Data description
	 *
	 * @var mixed 
	 *
	 */	
	private $Data;
	/**
	 * This is variable Redirect description
	 *
	 * @var mixed 
	 *
	 */	
	private $Redirect;
	
	/**
	 * This is variable Headers description
	 *
	 * @var mixed 
	 *
	 */	
	private $Headers;
	
	/**
	 * This is variable ContentType description
	 *
	 * @var mixed 
	 *
	 */	
	private $ContentType;
	
	/**
	 * This is variable Context description
	 *
	 * @var mixed 
	 *
	 */	
	public $Context;
	
	
	public $Cookies; //= HttpCookieCollection::HttpCookieCollection;
	
	
	protected $Request;
	
	
	private $StatusMessages = array(
		100 => "Continue",
		101 => "Switching Protocols",
		200 => "OK",
		201 => "Created",
		202 => "Accepted",
		203 => "Non-Authoritative Information",
		204 => "No Content",
		205 => "Reset Content",
		206 => "Partial Content",
		300 => "Multiple Choices",
		301 => "Moved Permanently",
		302 => "Found",
		303 => "See Other",
		304 => "Not Modified",
		305 => "Use Proxy",
		307 => "Temporary Redirect",
		400 => "Bad Request",
		401 => "Unauthorized",
		402 => "Payment Required",
		403 => "Forbidden",
		404 => "Not Found",
		405 => "Method Not Allowed",
		406 => "Not Acceptable",
		407 => "Proxy Authentication Required",
		408 => "Request Timeout",
		409 => "Conflict",
		410 => "Gone",
		411 => "Length Required",
		412 => "Precondition Failed",
		413 => "Request Entity Too Large",
		414 => "Request-URI Too Long",
		415 => "Unsupported Media Type",
		416 => "Requested Range Not Satisfiable",
		417 => "Expectation Failed",
		500 => "Internal Server Error 2",
		501 => "Not Implemented",
		502 => "Bad Gateway",
		503 => "Service Unavailable",
		504 => "Gateway Timeout",
		505 => "HTTP Version Not Supported",
		);
	/**
	 * HttpResponse constructor
	 *
	 * @param $Code
	 * @param $ContentType
	 * @param Headers
	 * 
	 */
	
	public	 function __construct($Code = 200 ,	$ContentType ="text/html" )
	{
		
		$this->Code         =	$Code;

		$this->ContentType  =   $ContentType;
		
		$this->Headers		=	new HttpHeaderCollection(null,$this); 
		
		$this->Cookies      =   new  HttpCookieCollection($this,false);
        
        
        $this->Headers->Add("content-type","text/html; charset=utf-8");
		
        $this->Headers->Add("X-Powered-By","Orion Mvc Framework php 5.4");
        
				
		return $this;
	}
	
	/**
	 * This is method redirect
	 *
	 * @param mixed $url This is a description
	 * @param mixed $code This is a description
	 * @param mixed $method This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function Redirect($Url = NULL, $Code = 302, $Method = 'location')
	{
		if(strpos($Url, '://') === FALSE)
		{
			$url = site_url($Url);
		}
		
		$this->Context->Request->SetHeader('Refresh',$Method == 'refresh' ? "Refresh:0;url = $Url" : "Location: $Url");
		header($Method == 'refresh' ? "Refresh:0;url = $Url" : "Location: $Url", TRUE, $Code);
	}
	
	public function SetCookie(HttpCookie $Cookie)
	{
		$this->Cookies->AddCookie($Cookie);	
		
	}
	
	public function SetHeaderCode($Code)
	{
		$this->Headers->SetHeader("StatusCode",$this->StatusMessages[$Code]);
	}
	
	public function GetHeaderCode($Code = null)
	{
		if ($Code !== NULL) {

			switch ($Code) {
				case 100: $text = 'Continue'; break;
				case 101: $text = 'Switching Protocols'; break;
				case 200: $text = 'OK'; break;
				case 201: $text = 'Created'; break;
				case 202: $text = 'Accepted'; break;
				case 203: $text = 'Non-Authoritative Information'; break;
				case 204: $text = 'No Content'; break;
				case 205: $text = 'Reset Content'; break;
				case 206: $text = 'Partial Content'; break;
				case 300: $text = 'Multiple Choices'; break;
				case 301: $text = 'Moved Permanently'; break;
				case 302: $text = 'Moved Temporarily'; break;
				case 303: $text = 'See Other'; break;
				case 304: $text = 'Not Modified'; break;
				case 305: $text = 'Use Proxy'; break;
				case 400: $text = 'Bad Request'; break;
				case 401: $text = 'Unauthorized'; break;
				case 402: $text = 'Payment Required'; break;
				case 403: $text = 'Forbidden'; break;
				case 404: $text = 'Not Found'; break;
				case 405: $text = 'Method Not Allowed'; break;
				case 406: $text = 'Not Acceptable'; break;
				case 407: $text = 'Proxy Authentication Required'; break;
				case 408: $text = 'Request Time-out'; break;
				case 409: $text = 'Conflict'; break;
				case 410: $text = 'Gone'; break;
				case 411: $text = 'Length Required'; break;
				case 412: $text = 'Precondition Failed'; break;
				case 413: $text = 'Request Entity Too Large'; break;
				case 414: $text = 'Request-URI Too Large'; break;
				case 415: $text = 'Unsupported Media Type'; break;
				case 500: $text = 'Internal Server Error'; break;
				case 501: $text = 'Not Implemented'; break;
				case 502: $text = 'Bad Gateway'; break;
				case 503: $text = 'Service Unavailable'; break;
				case 504: $text = 'Gateway Time-out'; break;
				case 505: $text = 'HTTP Version not supported'; break;
				default:
					exit('Unknown http status code "' . htmlentities($Code) . '"');
					break;
			}

			$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

			$this->Headers->SetHeader($protocol . ' ' . $Code . ' ' . $text);

			$GLOBALS['http_response_code'] = $Code;

		} else {

			$Code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);

		}

		return $Code;
	}
	
	/**
	* This is method GetHeader
	*
	* @return mixed This is the return value description
	*
	*/
	public	function GetHeader()
	{
		if(is_null($this->Headers))
		{
			if (function_exists('apache_request_headers')) 
			{
				$this->Headers =  array_change_key_case(apache_request_headers(), CASE_LOWER);
			}else{
				foreach($_SERVER as $k => $v)
				{
					if (strncmp($k, 'HTTP_', 5) == 0) {
						$k = substr($k, 5);
					} elseif (strncmp($k, 'CONTENT_', 8)) {
						continue;
					}
					$this->SetHeader( strtr(strtolower($k), '_', '-') , $v);
				}
			}
		}
		return $this->Headers;
	}
	
	public function SendHeaders()
	{
		
		if (headers_sent())
		{
			return $this;
		}

		
		if (isset($_SERVER['SERVER_PROTOCOL']))
			$protocol = $_SERVER['SERVER_PROTOCOL'];
		else
			$protocol = 'HTTP/1.1';
		

		// headers
		header($protocol.' '.$this->Code.' '.$this->StatusMessages[$this->Code]);
		
		// headers
		foreach ($this->GetHeader() as $name => $value)
		{
			header($name.':'.$value, true);
		}
		
        $_cookies = $this->Context->Request->Cookies;
		// cookies
		foreach ($this->Cookies as $cookie)
		{
			setcookie($cookie->name, $cookie->value, $cookie->expires, $cookie->path, $cookie->domain, $cookie->secure, $cookie->hostonly);
		}

		return $this;
		
	}
	
	public function SendJson($T_Object = null)
	{
		$this->SetBody($T_Object);
		$this->Headers->SetHeader('Content-Type' , 'application/json; charset=utf-8');
		$this->Send();
	}
	
	public function Secure()
	{
		
		if(isset($_SERVER['HTTPS'])&&strtolower($_SERVER['HTTPS'])==='on')return;
		
	}
	
	public function SetBody($Content)
	{
		if ($Content === null) 
		{
			return $this->Body;
		}
		$this->Body = $Content;
		return $this;
	}
	
	public function GetBody()
	{
		return (string) $this->Body;	
	}
	
	public function SendBody()
	{
		echo (string) $this->Body;
		
		return $this;	
	}
	
	public function Send()
	{
		
		$this->SendHeaders();
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
    
    public function BeforeCookieCollection()
    {
        if(headers_sent())
        {
            throw OrionException::Handler(new Exception\ErrorException("Cannot modify cookies after headers sent"));
        }
    }
    
    public function OnCookieAdd(HttpCookie $cookie)
    {
        $this->Context->Request->AddResponseCookie($cookie);
    }
	
	/**
	 * This is method __get
	 *
	 * @param mixed $Variable This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public	 function __get($property)
	{
		//return $this->$Variable;
		switch($property)
		{
			case 'Request':
				$this->Request = $this->Context->Request;
				return $this->Request;
				break;
			case 'Headers':
				return $this->Headers;
				break;
		}
	}
	
	/**
	 * This is method __set
	 *
	 * @param mixed $Variable This is a description
	 * @param mixed $Value This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function __set($Variable,$Value)
	{
		$this->$Variable = $Value;
	}
	
	
	public function __toString()
	{
		return		(string)	sprintf('HTTP/%s %s %s', (isset($_SERVER['SERVER_PROTOCOL'])? $_SERVER['SERVER_PROTOCOL']:'HTTP/1.1'), $this->Code,$this->StatusMessages[$this->Code])."\r\n".			$this->Headers."\r\n". $this->GetBody();
	}
	
	public function __clone()
	{
		$this->Headers = clone $this->Headers;
	}
	
}

?>