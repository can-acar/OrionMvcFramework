<?php
namespace OrionMvc\Exception;


class RouterException extends Exception
{
	function __construct($Exception)
	{
		parent::__construct("Router Exception.");
	}
}

?>