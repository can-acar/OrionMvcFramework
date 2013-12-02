<?php

namespace OrionMvc;
/**
 * This is interface IRoute
 *
 */
interface IRoute
{/**
	 * This is function getPath
	 *
	 * @return mixed This is the return value description
	 *
	 */
	public function getPath();
	
	/**
	 * This is function getDefault
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public function getDefault();
	
	/**
	 * This is function getFormat
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public function getFormat();
	
	/**
	* This is @method getUrlSchema();
	* 
    */
	public function getUrlSchema();
}

?>