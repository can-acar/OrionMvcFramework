<?php
namespace OrionMvc;
/**
 * class Uri
 *
 * Description for class Uri
 *
 * @author:
*/
class Uri  {

	/**
	 * Uri constructor
	 *
	 * @param 
	 */
	public function __construct($Url)
	{
		/*	$parsed_url 	= parse_url( $Url );
			$scheme 		= (isset($parsed_url['scheme'])?$parsed_url['scheme']:'');
			$port			= (isset($parsed_url['port'])?$parsed_url['port']:$this->port);
			$host 			= (isset($parsed_url['host'])?$parsed_url['host']:$this->host);
			$request_file 	= (isset($parsed_url['path'])?$parsed_url['path']:'');
			$query_string 	= (isset($parsed_url['query'])?$parsed_url['query']:'');
			if ( substr( $request_file, 0, 1 ) != '/' )
				 $request_file = $this->_current_directory( $this->uri ) . $request_file;
 
			return array(	'scheme' => $scheme,
							'port' => $port,
							'host' => $host,
							'request_file' => $request_file,
							'query_string' => $query_string 
						);*/
		return $Url;
	}

	
}

?>