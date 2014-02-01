<?php

	namespace OrionMvc;

	use OrionMvc;
	use Exception;

	/**
	 * class OrionException
	 * 
	 * @access public
	 * @since 2013
	 * @author:can acar
	 */
	class OrionException  {

		
		protected  $Context;
		
		protected  $Application;
		
		private static $Instance = null;
		
		public $RenderView = true;
		
		/**
		 * Exception constructor
		 *
		 * @param 
		 */
		protected function __construct( )
		{
			
			ini_set('display_errors', 'off');
			ini_set('html_errors', 'off');
			0 == error_reporting() &&  @error_reporting(-1);
			return;
			
		}
		
		/**
		 * This is method Instance
		 *
		 * @return mixed This is the return value description
		 *
		 */	
		public static function Instance()
		{
			
			if(null == self::$Instance)
			{
				self::$Instance = new static();
			}
			return self::$Instance;
		}
		
		
		/**
		 * This is method Register
		 *
		 * @param mixed $ErrorCode This is a description
		 * @param mixed $ErrorMessage This is a description
		 * @param mixed $ErrorFile This is a description
		 * @param mixed $ErrorLine This is a description
		 * @param array $ErrorContext This is a description
		 * @param mixed $e This is a description
		 * @return mixed This is the return value description
		 *
		 */	
		public function Register()
		{
			
			set_exception_handler(array(&$this,"ExceptionHandler"));
			
			set_error_handler(array(&$this,"ErrorHandler"));
			
			register_shutdown_function(array(&$this,"FatalError"));
			
			
		}
		
		
		/**
		 * This is method ExceptionHandler
		 *
		 * @param Exception $Exception This is a description
		 * @return mixed This is the return value description
		 *
		 */
		public  function ExceptionHandler(\Exception $exception )
		{
			if (0 === error_reporting()) { return false; }
			$title = 'Orion Application Error';
			$code = $exception->getCode();
			$message = $exception->getMessage();
			$file = $exception->getFile();
			$line = $exception->getLine();
			$trace = $exception->getTraceAsString();
			$html = sprintf('<h1>%s</h1>', $title);
			$html .= '<p>The application could not run because of the following error:</p>';
			$html .= '<h2>Details</h2>';
			$html .= sprintf('<div><strong>Type:</strong> %s</div>', get_class($exception));
			if ($code) {
				$html .= sprintf('<div><strong>Code:</strong> %s</div>', $code);
			}
			if ($message) {
				$html .= sprintf('<div><strong>Message:</strong> %s</div>', $message);
			}
			if ($file) {
				$html .= sprintf('<div><strong>File:</strong> %s</div>', $file);
			}
			if ($line) {
				$html .= sprintf('<div><strong>Line:</strong> %s</div>', $line);
			}
			if ($trace) {
				$html .= '<h2>Trace</h2>';
				$html .= sprintf('<pre>%s</pre>', $trace);
			}

			$_view =  sprintf("<html><head><title>%s</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{display:inline-block;width:65px;}</style></head><body>%s</body></html>", $title, $html);
		
			
			//$_view = "<pre><p>{$Exception->getMessage()}</p></pre>";	
			
			exit($_view);
		}
		
		/**
		 * This is method ErrorHandler
		 *
		 * @param mixed $ErrorCode This is a description
		 * @param mixed $ErrorMessage This is a description
		 * @param mixed $ErrorFile This is a description
		 * @param mixed $ErrorLine This is a description
		 * @param array $ErrorContext This is a description
		 * @return mixed This is the return value description
		 *
		 */	
		public  function ErrorHandler($ErrorCode,$ErrorMessage,$ErrorFile,$ErrorLine,array $ErrorContext)
		{
			if (0 === error_reporting()) { return false; }
			
			if (function_exists('xdebug_get_function_stack'))
			{
				$trace = array_reverse(xdebug_get_function_stack());
			} else {
				$trace = debug_backtrace();
			}
			array_shift($trace);
			
			$message = "<pre><p>{$ErrorMessage} [{$ErrorFile}] ({$ErrorLine})</p></pre>";
			
			
			$Exception =	new \ErrorException($message, 0, $ErrorCode, $ErrorFile, $ErrorLine);
			
			$this->ExceptionHandler($Exception);
			
			exit;
			
		}
		

		/**
		 * This is method FatalError
		 *
		 * @return mixed This is the return value description
		 *
		 */	
		public  function FatalError()
		{
			if (!($error = error_get_last())) {
				return;
			}


			$fatals = array(
				E_ERROR             => 'ERROR',
				E_WARNING           => 'WARNING',
				E_PARSE             => 'PARSING ERROR',
				E_NOTICE            => 'NOTICE',
				E_CORE_ERROR        => 'CORE ERROR',
				E_CORE_WARNING      => 'CORE WARNING',
				E_COMPILE_ERROR     => 'COMPILE ERROR',
				E_COMPILE_WARNING   => 'COMPILE WARNING',
				E_USER_ERROR        => 'USER ERROR',
				E_USER_WARNING      => 'USER WARNING',
				E_USER_NOTICE       => 'USER NOTICE',
				E_STRICT            => 'STRICT NOTICE',
				E_RECOVERABLE_ERROR => 'RECOVERABLE ERROR'
				);
			
			//if (($error && isset($error['type']) && in_array($error['type'], $fatals))==true)
			//{
			/*		if (function_exists('xdebug_get_function_stack')) 
					{
						$trace = array_reverse(xdebug_get_function_stack());
						
					} else {
						
						$trace = debug_backtrace();
						
					}
					
					array_shift($trace);*/
			
			$message = "<pre><p>{$error['message']} [{$error['file']}] ({$error['line']})</p></pre>";
			
			$FatalException = new \ErrorException($message, 0, $error['type'], $error['file'], $error['line']);
			
			throw	$this->ExceptionHandler($FatalException);
			
			//}
			
		}
		


		public static function logError( $errorNumber, $errorString, $errorFile, $errorLine ) {
			$errorInfo['errorString'] = sprintf( '%s - %s: %s in %s on line %s.',
				strftime("%d.%m.%Y",time()),
				self::getErrorType( $errorNumber ),
				$errorString,
				$errorFile,
				$errorLine );
			$errorInfo['backTrace'] = self::parseBackTrace( debug_backtrace( ), 'error' );
			self::$errorLog[] = $errorInfo;
		}

		
		

		
		/**
		 * This is method Handler
		 *
		 * @param Exception $e This is a description
		 * @return mixed This is the return value description
		 *
		 */	
		public static function Handler(Exception $e)
		{
			return	self::$Instance->ExceptionHandler($e);
		}
		
		
		
	}

?>