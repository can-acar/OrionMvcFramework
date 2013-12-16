<?php
namespace OrionMvc\Exception;
/**
 * class Exception
 *
 * Description for class Exception
 *
 * @author:
*/
class ExceptionRender extends \ArrayObject {

	/**
	 * Exception constructor
	 *
	 * @param 
	 */
	public function __construct( array $ExceptionCollection  = null)
	{
		parent::__construct($ExceptionCollection , \ArrayObject::ARRAY_AS_PROPS);
		var_dump($ExceptionCollection);
	}
	
	public function Render($view)
	{
		$level = ob_get_level();


		$this->__f = \Application::FindFile($view,ABSPATH.'OrionMvc'.DIRECTORY_SEPARATOR.'Exeption'.DIRECTORY_SEPARATOR.'Template'.DIRECTORY_SEPARATOR); 
		
		if (file_exists($this->__f) == false) {
			$_m = sprintf("<p>%s %s template not found!</p>",$path,$view);
			echo($_m);
			
			return false;
		}
		
		ob_start();
		
	/*	if($this->ViewData)
		{
			extract($this->ViewData,EXTR_SKIP);
		}
		*/

		try{
			 
			require($this->__f);

		}catch(\Exception $e)
		{
			
			while (ob_get_level() > $level)
			{
                ob_end_clean();
            }
			
			throw	OrionException::Handler(new ErrorException("View Rendering Exception!."));
			
			
		}

		return ob_get_clean();
	}
	
	
	
	/*private static function parseBackTrace( $backTrace, $type ) {
		if( $type == 'error' ) {
			unset( $backTrace[0] );
		}
		$backTrace = array_reverse( $backTrace );
		if ( count( $backTrace ) < 1 ) {
			return;
		}
		$string = '';
		$tabs = "";
		foreach( $backTrace as $key => $value ) {
			if ( $key ) {
				$tabs .= "\t";
			}
			$string .= sprintf( "\n$tabs File %s on line %s.\n\t$tabs%s%s%s\n",
				$value['file'],
				$value['line'],
				( !empty( $value['object'] ) ? get_class( $value['object'] ).$value['type'] : null ),
				$value['function'],
				( count( $value['args'] ) ? '( "'.implode( '", "', $value['args'] ).'" )' : '( )' ) );
		}
		return $string;*/
}


?>