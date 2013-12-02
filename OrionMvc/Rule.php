<?php

namespace OrionMvc;

class Rule  implements IRule
{

	private $Rule = array();

	function __construct($rule)
	{
		$this->Rule = $rule;
		return $this;
	}
	
	public	function getRule()
	{
		return $this->Rule;
	}

}
?>