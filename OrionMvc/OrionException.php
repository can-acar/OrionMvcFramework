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
	public  function ExceptionHandler(\Exception $Exception )
	{
		if (0 === error_reporting()) { return false; }
	
		$message = "<pre><p>{$Exception->getMessage()}</p></pre>";
			
		exit($message);
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