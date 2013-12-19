<?php
namespace OrionMvc;

/**
 * This is class Session
 *
 */

class Session implements ISession 
{

	private $sess_save_path;
	private $sess_name;


	public	function __construct()
	{
		
		session_set_save_handler(
			array($this,"open"),
			array($this,"close"),
			array($this,"read"),
			array($this,"write"),
			array($this,"destroy"),
			array($this,"gc")
			);
		register_shutdown_function(array($this,"dispose"));
		session_start();

		return $this;
	}


	public 	function open($save_path, $session_name)
	{

		$this->sess_name = $session_name;
		$this->sess_save_path = $save_path;

		return TRUE;
	}

	public	function close()
	{
		return TRUE;
	}

	public	function read($id)
	{

		$sess_file = $this->sess_save_path."/sess_$id";

		if(file_exists($sess_file))
		{
			
			return (string) @file_get_contents($sess_file);


		}
		return false;

	}

	public	function write($id, $sess_data)
	{

		$sess_file = $this->sess_save_path."/sess_$id";
		if ($fp = @fopen($sess_file, "w")) {
			$return = fwrite($fp, $sess_data);
			fclose($fp);
			return $return;
		}else {
			return FALSE;
		}

	}

	public	function destroy($id)
	{

		$sess_file = $this->sess_save_path."/sess_$id";
		return(@unlink($sess_file));
	}
	
	public	function gc($maxlifetime)
	{
		foreach (glob($this->sess_save_path."/sess_*") as $filename) {
			if (filemtime($filename) + $maxlifetime < time()) {
				@unlink($filename);
			}
		}
		return true;
	}

	public	function __set($k,$v)
	{

		$_SESSION[$k] = $v;
	}

	public	function __unset($k)
	{
		if (array_key_exists($k,$_SESSION)) {
			unset($_SESSION[$k]);
		}


	}

	public	function __get($k)
	{

		if (array_key_exists($k,$_SESSION)) {
			return $_SESSION[$k];
		}else {
			return FALSE;
		}

	}

	public	function dispose()
	{
		session_write_close();

	}


	public	function Abonden()
	{
		unset($_SESSION);
		unset($_COOKIE);
		unset($this);
		$sess_file = $this->sess_save_path."/sess_".session_id();
		return(@unlink($sess_file));
	}


}