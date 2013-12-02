<?php
namespace OrionMvc;


class InvokeActionFilter extends \ArrayObject
{

	private $Controller;
	private $Action;

	public	function __construct($Action)
	{
		$this->Controller = $Action->class;
		$this->Action = $Action->name;

		$contents = file_get_contents($Action->getFileName(),null,null,$Action->getStartLine());
		$attribute;
		foreach ($this->Attribute as $i=>$key) {
			$str_arr = $this->ParseAttribute($key, $contents  );
			//$attribute[$key] = Ar
			
			//var_dump($key,$str_arr );

		}


	}

	private	function ParseAttribute($Filter,$content)
	{
		$matches = array();
		$regex = "/(?P<$Filter>#$Filter#[\s\n]+(\S+)[\s\n]*(?:[^\s\n])+(?:[^function])function[\s\n]+(\S+)[\s\n]*\((.*)\))/im";
		//$regex = "/(#((?:$Filter)*)#[\s\n]+(\S+)[\s\n]*(?:[^\s\n])+(?:[^function])+function[\s\n]+(\S+)[\s\n]*\((.*)\))/mi";
		preg_match_all($regex, $content, $matches);
		return $matches;
	}

	protected $Attribute = array('HttpPost','HttpGet','MultiPartData','JsonResult');

	/**
	*
	* @param object $Action, This method Controller action filter attribute return bool
	* @return bool
	*
	*/
	private	function MethodAttribute($Action)
	{

		$matches = array();
		preg_match("/[]:(.*)(\\r\\n|\\r|\\n)/U", $Action, $matches);

		if (isset($matches[1])) {
			return trim($matches[1]);
		}

		return '';
	}


}
?>