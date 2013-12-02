<?php
namespace OrionMvc;
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
	
	public function Render()
	{
		
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