<?php
	namespace OrionMvc;
	use Exception;
	/**
	 * class Json
	 *
	 * Description for class Json
	 *
	 * @author:
	*/
	class Json  {

		/**
		 * Json constructor
		 *
		 * @param $object
		 */
		protected $JsonResult;
		
		
		
		public function __construct(array $object,$contenttype = "application/json",$encoding="utf-8")
		{
			
		}
		
		public static function Encoding($Data, $Options = 0)
		{
			
			$json = json_encode($Data,$Options);
			self::JsonErrorCheck();
			return $json;
		}
		
		public static function Decoding($Json,$Assoc = false , $detph = 512 ,$Options = 0)
		{
			if (strpos($Json, "\n") === false && is_file($Json))
			{
				
				if (false === is_readable($Json))
				{
					throw OrionException::Handler( new RuntimeException(sprintf('Unable to parse "%s" as the file is not readable.', $json)));
					
				}
				
				$json = file_get_contents($json);	  
			}
			
			$data = json_decode($json, $assoc, $depth,$Options);
			
			self::JsonErrorCheck();

			return $data;
		}
		
		
		
		protected static function JsonErrorCheck()
		{
			$code = json_last_error();

			switch ($code) {
				case JSON_ERROR_NONE:
					$errorMsg = null;
					break;
				case JSON_ERROR_DEPTH:
					$errorMsg = ' - Maximum stack depth exceeded';
					break;
				case JSON_ERROR_STATE_MISMATCH:
					$errorMsg = ' - Underflow or the modes mismatch';
					break;
				case JSON_ERROR_CTRL_CHAR:
					$errorMsg = ' - Unexpected control character found';
					break;
				case JSON_ERROR_SYNTAX:
					$errorMsg = ' - Syntax error, malformed JSON';
					break;
				case JSON_ERROR_UTF8:
					$errorMsg = ' - Malformed UTF-8 characters, possibly incorrectly encoded';
					break;
				default:
					$errorMsg = ' - Unknown error';
					break;
			}

			if (null !== $errorMsg) {
				throw OrionException::Handler(new RuntimeException(sprintf('JSON Error%s', $errorMsg), $code));
			}

			return false;
		}
	}

?>