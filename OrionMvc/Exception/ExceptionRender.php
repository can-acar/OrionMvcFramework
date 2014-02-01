<?php
	namespace OrionMvc\Exception;
	use OrionMvc;
	/**
	 * class Exception
	 *
	 * Description for class Exception
	 *
	 * @author:
	*/
	class ExceptionRender {

		protected $Context = null;
		/**
		 * Exception constructor
		 *
		 * @param 
		 */
		public function __construct(   Exception $Exception,$Context)
		{
			
			$this->Context = $Context;
			$_body = $this->Render($Exception);
			//$this->Context->Response->SetBody($_body);
			return $_body;

		}
		
		protected function Render($exception)
		{

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

			return sprintf("<html><head><title>%s</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{display:inline-block;width:65px;}</style></head><body>%s</body></html>", $title, $html);
			
		}
		
		
		
	}


?>