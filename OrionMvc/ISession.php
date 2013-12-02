<?php
namespace OrionMvc;
/**
 * This is interface ISession
 *
 */
interface ISession
{
	
	/**
	 * This is function open
	 *
	 * @param mixed $save_path This is a description
	 * @param mixed $session_name This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public  function open($save_path, $session_name);
	/**
	 * This is function close
	 *
	 * @return mixed This is the return value description
	 *
	 */
	public  function close();
	/**
	 * This is function read
	 *
	 * @param mixed $id This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public  function read($id);
	/**
	 * This is function write
	 *
	 * @param mixed $id This is a description
	 * @param mixed $sess_data This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public	function write($id, $sess_data);
	/**
	 * This is function gc
	 *
	 * @param mixed $maxlifetime This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public	function gc($maxlifetime);
	/**
	 * This is function destroy
	 *
	 * @param mixed $id This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public	function destroy($id);
	/**
	 * This is function dispose
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public	function dispose();
	/**
	 * This is function Abonden
	 *
	 * @return mixed This is the return value description
	 *
	 */	
	public	function Abonden();
}


?>