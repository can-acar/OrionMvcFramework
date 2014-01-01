<?php

	namespace OrionMvc;

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
		 * 
		 * @var $CacheControl
		 */
		public $CacheControl;
		
		/**
		 * This is variable Connection description
		 *
		 * @var mixed 
		 *
		 */		
		public $Connection;
		
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
		public $Cookies;

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
		
		/**
		        * Description
		        * @var $Contents
		        * @property $Contents;
		        */
		public $Contents;
		
		
		public $IP;
		

		
		public $_wr;
		
		
		/**
		 * HttpRequest::__construct()
		 * 
		 * 
		 */
		public function __construct($uri=null, $method = null,$queryString = null,$Contents = null){
			

			$this->Contents     =   null;
			$this->HttpMethod   =   $method;
			$this->Url          =	new Uri($uri);
			$this->ContentLength = -1;
			$this->_wr          = null;
			
			$this->GetServerVars();
			
			$this->EnsureHeaders();
			
			$this->EnsureCookies();
			
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

		/* HttpRequest::FillInParamsCollection
		 *
		 */
		function FillInParamsCollection()
		{
			$this->Params->Add($this->QueryString);
			$this->Params->Add($this->Form);
			$this->Params->Add($this->Cookies);
			$this->Params->Add($this->ServerVariables);
			
		}
		
		/** 
		 * HttpRequest::FillInServerVariablesCollection()
		 *
		 */
		public function FillInServerVariablesCollection()
		{
			if($this->_wr !=null)
			{
				foreach($_SERVER  as $name => $value)
				{
					switch($name)
					{
						case 'REDIRECT_STATUS':
							break;
						case 'HTTP_HOST':
							$this->UserHostName = $value;
							break;
						case 'HTTP_CONNECTION':
							$this->Connection = $value;
							break;
						case 'HTTP_CACHE_CONTROL':
							$this->CacheControl = $value;
							break;
						case 'HTTP_ACCEPT':
							$this->AcceptTypes = $value;
							break;
						case 'HTTP_USER_AGENT':
							$this->UserAgent = $value;
							$this->Browser = $value;
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
							$this->ApplicationPath = $value.DIRECTORY_SEPARATOR.'Application'.DIRECTORY_SEPARATOR;
							break;
						case 'REQUEST_METHOD':
							$this->HttpMethod = $value;
							break;
						case 'QUERY_STRING':
							$this->QueryString = $value;
							$this->QueryStringParams = null;
							break;
						case 'REQUEST_URI':
							$this->Path =	filter_var( $value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
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
			
			$context = stream_context_create(array ('http' => array(
				'method' => $this->HttpMethod,
				'header' => $this->Headers,
				'content' => http_build_query( $this->QueryString )
				)
						)
					);
			
			$this->Contents =   file_get_contents($this->Url, false, $context);
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
				throw	OrionException::Handler(new Exception\ErrorException("Headers already sent! Tip: try ob_start() before calling send()]"));

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
				throw	OrionException::Handler(new Exception\ErrorException("Headers already sent! Tip: try ob_start() before calling send()]"));
				
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
		
		


		/**
		 * Gets the Gets a string array of client-supported MIME accept types..
		 *
		 * @return $AcceptTypes
		 */
		public function getAcceptTypes()
		{
			return $this->AcceptTypes;
		}

		/**
		 * Sets the Gets a string array of client-supported MIME accept types..
		 *
		 * @param $AcceptTypes $AcceptTypes the accept types
		 *
		 * @return self
		 */
		public function setAcceptTypes(AcceptTypes $AcceptTypes)
		{
			$this->AcceptTypes = $AcceptTypes;

			return $this;
		}

		/**
		 * Gets the Gets the php application's virtual application root path on the server..
		 *
		 * @return mixed
		 */
		public function getApplicationPath()
		{
			return $this->ApplicationPath;
		}

		/**
		 * Sets the Gets the php application's virtual application root path on the server..
		 *
		 * @param mixed $ApplicationPath the application path
		 *
		 * @return self
		 */
		public function setApplicationPath($ApplicationPath)
		{
			$this->ApplicationPath = $ApplicationPath;

			return $this;
		}

		/**
		 * Gets the Gets or sets information about the requesting client's browser capabilities..
		 *
		 * @return mixed
		 */
		public function getBrowser()
		{
			return $this->Browser;
		}

		/**
		 * Sets the Gets or sets information about the requesting client's browser capabilities..
		 *
		 * @param mixed $Browser the browser
		 *
		 * @return self
		 */
		public function setBrowser($Browser)
		{
			$this->Browser = $Browser;

			return $this;
		}

		/**
		 * Gets the This is variable ContentEncoding description.
		 *
		 * @return mixed
		 */
		public function getContentEncoding()
		{
			return $this->ContentEncoding;
		}

		/**
		 * Sets the This is variable ContentEncoding description.
		 *
		 * @param mixed $ContentEncoding the content encoding
		 *
		 * @return self
		 */
		public function setContentEncoding($ContentEncoding)
		{
			$this->ContentEncoding = $ContentEncoding;

			return $this;
		}

		/**
		 * Gets the This is variable ContentLength description.
		 *
		 * @return mixed
		 */
		public function getContentLength()
		{
			return $this->ContentLength;
		}

		/**
		 * Sets the This is variable ContentLength description.
		 *
		 * @param mixed $ContentLength the content length
		 *
		 * @return self
		 */
		public function setContentLength($ContentLength)
		{
			$this->ContentLength = $ContentLength;

			return $this;
		}

		/**
		 * Gets the This is variable ContentType description.
		 *
		 * @return mixed
		 */
		public function getContentType()
		{
			return $this->ContentType;
		}

		/**
		 * Sets the This is variable ContentType description.
		 *
		 * @param mixed $ContentType the content type
		 *
		 * @return self
		 */
		public function setContentType($ContentType)
		{
			$this->ContentType = $ContentType;

			return $this;
		}

		/**
		 * Gets the This is variable Context description.
		 *
		 * @return mixed
		 */
		public function getContext()
		{
			return $this->Context;
		}

		/**
		 * Sets the This is variable Context description.
		 *
		 * @param mixed $Context the context
		 *
		 * @return self
		 */
		public function setContext($Context)
		{
			$this->Context = $Context;

			return $this;
		}

		/**
		 * Gets the Gets a collection of cookies sent by the client..
		 *
		 * @return Cookie;
		 */
		public function getCookies()
		{
			return $this->Cookies;
		}

		/**
		 * Sets the Gets a collection of cookies sent by the client..
		 *
		 * @param Cookie; $Cookies the cookies
		 *
		 * @return self
		 */
		public function setCookies($Cookies)
		{
			$this->Cookies = $Cookies;

			return $this;
		}

		/**
		 * Gets the This is variable CurrentExecutionFilePath description.
		 *
		 * @return mixed
		 */
		public function getCurrentExecutionFilePath()
		{
			return $this->CurrentExecutionFilePath;
		}

		/**
		 * Sets the This is variable CurrentExecutionFilePath description.
		 *
		 * @param mixed $CurrentExecutionFilePath the current execution file path
		 *
		 * @return self
		 */
		public function setCurrentExecutionFilePath($CurrentExecutionFilePath)
		{
			$this->CurrentExecutionFilePath = $CurrentExecutionFilePath;

			return $this;
		}

		/**
		 * Gets the This is variable FilePath description.
		 *
		 * @return mixed
		 */
		public function getFilePath()
		{
			return $this->FilePath;
		}

		/**
		 * Sets the This is variable FilePath description.
		 *
		 * @param mixed $FilePath the file path
		 *
		 * @return self
		 */
		public function setFilePath($FilePath)
		{
			$this->FilePath = $FilePath;

			return $this;
		}

		/**
		 * Gets the This is variable Files description.
		 *
		 * @return mixed
		 */
		public function getFiles()
		{
			return $this->Files;
		}

		/**
		 * Sets the This is variable Files description.
		 *
		 * @param mixed $Files the files
		 *
		 * @return self
		 */
		public function setFiles($Files)
		{
			$this->Files = $Files;

			return $this;
		}

		/**
		 * Gets the This is variable Filter description.
		 *
		 * @return mixed
		 */
		public function getFilter()
		{
			return $this->Filter;
		}

		/**
		 * Sets the This is variable Filter description.
		 *
		 * @param mixed $Filter the filter
		 *
		 * @return self
		 */
		public function setFilter($Filter)
		{
			$this->Filter = $Filter;

			return $this;
		}

		/**
		 * Gets the This is variable Form description.
		 *
		 * @return mixed
		 */
		public function getForm()
		{
			return $this->Form;
		}

		/**
		 * Sets the This is variable Form description.
		 *
		 * @param mixed $Form the form
		 *
		 * @return self
		 */
		public function setForm($Form)
		{
			$this->Form = $Form;

			return $this;
		}

		/**
		 * Gets the This is variable Headers description.
		 *
		 * @return mixed
		 */
		public function getHeaders()
		{
			return $this->Headers;
		}

		/**
		 * Sets the This is variable Headers description.
		 *
		 * @param mixed $Headers the headers
		 *
		 * @return self
		 */
		public function setHeaders($Headers)
		{
			$this->Headers->SetHeader($Headers);

			return $this;
		}

		/**
		 * Gets the This is variable HttpMethod description.
		 *
		 * @return mixed
		 */
		public function getHttpMethod()
		{
			return $this->HttpMethod;
		}

		/**
		 * Sets the This is variable HttpMethod description.
		 *
		 * @param mixed $HttpMethod the http method
		 *
		 * @return self
		 */
		public function setHttpMethod($HttpMethod)
		{
			$this->HttpMethod = $HttpMethod;

			return $this;
		}

		/**
		 * Gets the This is variable Item description.
		 *
		 * @return mixed
		 */
		public function getItem()
		{
			return $this->Item;
		}

		/**
		 * Sets the This is variable Item description.
		 *
		 * @param mixed $Item the item
		 *
		 * @return self
		 */
		public function setItem($Item)
		{
			$this->Item = $Item;

			return $this;
		}

		/**
		 * Gets the This is variable isAjax description.
		 *
		 * @return mixed
		 */
		public function getIsAjax()
		{
			return $this->isAjax;
		}

		/**
		 * Sets the This is variable isAjax description.
		 *
		 * @param mixed $isAjax the is ajax
		 *
		 * @return self
		 */
		public function setIsAjax($isAjax)
		{
			$this->isAjax = $isAjax;

			return $this;
		}

		/**
		 * Sets the This is variable Params description.
		 *
		 * @param mixed $Params the params
		 *
		 * @return self
		 */
		public function setParams($Params)
		{
			$this->Params = $Params;

			return $this;
		}

		/**
		 * Gets the This is variable Path description.
		 *
		 * @return mixed
		 */
		public function getPath()
		{
			return $this->Path;
		}

		/**
		 * Sets the This is variable Path description.
		 *
		 * @param mixed $Path the path
		 *
		 * @return self
		 */
		public function setPath($Path)
		{
			$this->Path = $Path;

			return $this;
		}

		/**
		 * Gets the This is variable PhysicalApplicationPath description.
		 *
		 * @return mixed
		 */
		public function getPhysicalApplicationPath()
		{
			return $this->PhysicalApplicationPath;
		}

		/**
		 * Sets the This is variable PhysicalApplicationPath description.
		 *
		 * @param mixed $PhysicalApplicationPath the physical application path
		 *
		 * @return self
		 */
		public function setPhysicalApplicationPath($PhysicalApplicationPath)
		{
			$this->PhysicalApplicationPath = $PhysicalApplicationPath;

			return $this;
		}

		/**
		 * Gets the This is variable PhysicalPath description.
		 *
		 * @return mixed
		 */
		public function getPhysicalPath()
		{
			return $this->PhysicalPath;
		}

		/**
		 * Sets the This is variable PhysicalPath description.
		 *
		 * @param mixed $PhysicalPath the physical path
		 *
		 * @return self
		 */
		public function setPhysicalPath($PhysicalPath)
		{
			$this->PhysicalPath = $PhysicalPath;

			return $this;
		}

		/**
		 * Gets the This is variable QueryString description.
		 *
		 * @return mixed
		 */
		public function getQueryString()
		{
			return $this->QueryString;
		}

		/**
		 * Sets the This is variable QueryString description.
		 *
		 * @param mixed $QueryString the query string
		 *
		 * @return self
		 */
		public function setQueryString($QueryString)
		{
			$this->QueryString = $QueryString;

			return $this;
		}

		/**
		 * Gets the This is variable RawUrl description.
		 *
		 * @return mixed
		 */
		public function getRawUrl()
		{
			return $this->RawUrl;
		}

		/**
		 * Sets the This is variable RawUrl description.
		 *
		 * @param mixed $RawUrl the raw url
		 *
		 * @return self
		 */
		public function setRawUrl($RawUrl)
		{
			$this->RawUrl = $RawUrl;

			return $this;
		}

		/**
		 * Gets the This is variable Request description.
		 *
		 * @return mixed
		 */
		public function getRequest()
		{
			return $this->Request;
		}

		/**
		 * Sets the This is variable Request description.
		 *
		 * @param mixed $Request the request
		 *
		 * @return self
		 */
		public function setRequest($Request)
		{
			$this->Request = $Request;

			return $this;
		}

		/**
		 * Gets the This is variable RquestType description.
		 *
		 * @return mixed
		 */
		public function getRequestType()
		{
			return $this->RequestType;
		}

		/**
		 * Sets the This is variable RquestType description.
		 *
		 * @param mixed $RequestType the request type
		 *
		 * @return self
		 */
		public function setRequestType($RequestType)
		{
			$this->RequestType = $RequestType;

			return $this;
		}

		/**
		 * Gets the This is variable ServerVariables description.
		 *
		 * @return mixed
		 */
		public function getServerVariables()
		{
			return $this->ServerVariables;
		}

		/**
		 * Sets the This is variable ServerVariables description.
		 *
		 * @param mixed $ServerVariables the server variables
		 *
		 * @return self
		 */
		public function setServerVariables($ServerVariables)
		{
			$this->ServerVariables = $ServerVariables;

			return $this;
		}

		/**
		 * Gets the This is variable Url description.
		 *
		 * @return mixed
		 */
		public function getUrl()
		{
			return $this->Url;
		}

		/**
		 * Sets the This is variable Url description.
		 *
		 * @param mixed $Url the url
		 *
		 * @return self
		 */
		public function setUrl($Url)
		{
			$this->Url = $Url;

			return $this;
		}

		/**
		 * Gets the This is variable UrlReferrer description.
		 *
		 * @return mixed
		 */
		public function getUrlReferrer()
		{
			return $this->UrlReferrer;
		}

		/**
		 * Sets the This is variable UrlReferrer description.
		 *
		 * @param mixed $UrlReferrer the url referrer
		 *
		 * @return self
		 */
		public function setUrlReferrer($UrlReferrer)
		{
			$this->UrlReferrer = $UrlReferrer;

			return $this;
		}

		/**
		 * Gets the This is variable UserAgent description.
		 *
		 * @return mixed
		 */
		public function getUserAgent()
		{
			return $this->UserAgent;
		}

		/**
		 * Sets the This is variable UserAgent description.
		 *
		 * @param mixed $UserAgent the user agent
		 *
		 * @return self
		 */
		public function setUserAgent($UserAgent)
		{
			$this->UserAgent = $UserAgent;

			return $this;
		}

		/**
		 * Gets the This is variable UserHostAdress description.
		 *
		 * @return mixed
		 */
		public function getUserHostAdress()
		{
			return $this->UserHostAdress;
		}

		/**
		 * Sets the This is variable UserHostAdress description.
		 *
		 * @param mixed $UserHostAdress the user host adress
		 *
		 * @return self
		 */
		public function setUserHostAdress($UserHostAdress)
		{
			$this->UserHostAdress = $UserHostAdress;

			return $this;
		}

		/**
		 * Gets the This is variable UserHostName description.
		 *
		 * @return mixed
		 */
		public function getUserHostName()
		{
			return $this->UserHostName;
		}

		/**
		 * Sets the This is variable UserHostName description.
		 *
		 * @param mixed $UserHostName the user host name
		 *
		 * @return self
		 */
		public function setUserHostName($UserHostName)
		{
			$this->UserHostName = $UserHostName;

			return $this;
		}

		/**
		 * Gets the This is variable UserLanguages description.
		 *
		 * @return mixed
		 */
		public function getUserLanguages()
		{
			return $this->UserLanguages;
		}

		/**
		 * Sets the This is variable UserLanguages description.
		 *
		 * @param mixed $UserLanguages the user languages
		 *
		 * @return self
		 */
		public function setUserLanguages($UserLanguages)
		{
			$this->UserLanguages = $UserLanguages;

			return $this;
		}


		/**
		 * Sets the value of Contents.
		 *
		 * @param mixed $Contents the contents
		 *
		 * @return self
		 */
		public function setContents($Contents)
		{
			$this->Contents = $Contents;

			return $this;
		}

		/**
		 * Gets the value of IP.
		 *
		 * @return mixed
		 */
		public function getIP()
		{
			return $this->IP;
		}

		/**
		 * Sets the value of IP.
		 *
		 * @param mixed $IP the i p
		 *
		 * @return self
		 */
		public function setIP($IP)
		{
			$this->IP = $IP;

			return $this;
		}

		/**
		 * Gets the value of _wr.
		 *
		 * @return mixed
		 */
		public function get_wr()
		{
			return $this->_wr;
		}

		/**
		 * Sets the value of _wr.
		 *
		 * @param mixed $_wr the _wr
		 *
		 * @return self
		 */
		public function set_wr($_wr)
		{
			$this->_wr = $_wr;

			return $this;
		}

	}
?>