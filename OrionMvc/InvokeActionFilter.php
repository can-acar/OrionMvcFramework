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
		//\Application::Debug($Action);
		/*$attribute;
		foreach ($this->Attribute as $i=>$key) {
			$str_arr = $this->ParseAttribute($key, $contents  );
			//$attribute[$key] = Ar
			
			\Application::Debug($key,$str_arr );

		}*/
		$_row = explode(  "\n",$contents );
		
		//\Application::Debug($_row[$Action->getStartLine()-4],$this);
		
		
		$file = new \SplFileObject($Action->getFileName());
		
		 foreach ($file as $line) 
		 {
		     
			//\Application::Debug(  $Action->getStartLine(),$_row);
		}

	}

	private	function ParseAttribute($Filter,$content)
	{
		$matches = array();
		$regex = "/(?P<$Filter>\#$Filter\#[\s\n]+(\S+)[\s\n]*(?:[^\s\n])+(?:[^function])function[\s\n]+(\S+)[\s\n]*\((.*)\))/im";
		//$regex = "/(#((?:$Filter)*)#[\s\n]+(\S+)[\s\n]*(?:[^\s\n])+(?:[^function])+function[\s\n]+(\S+)[\s\n]*\((.*)\))/mi";
		\Application::ConsoleLog("$regex");
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

	public function Invoke(){
	}


}
?>