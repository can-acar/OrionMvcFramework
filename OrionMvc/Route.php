<?php
	namespace OrionMvc;
	/**
	 * class Route
	 *
	 * Description for class Route
	 *
	 * @author:
	*/
	class Route extends AbstractRoute implements IRoute 
	{
		/**
		 * This is variable Path description
		 *
		 * @var mixed 
		 *
		 */
		public $Path;
		
		/**
		 * This is variable Default description
		 *
		 * @var mixed 
		 *
		 */	
		protected $Default = array();

		/**
		 * This is variable Rule description
		 *
		 * @var mixed 
		 *
		 */	
		public $Rule = array();
		
		
		/**
		 * This is method __construct
		 *
		 * @param mixed $path This is a description
		 * @param mixed $default This is a description
		 * @param mixed $rule This is a description
		 * @return mixed This is the return value description
		 *
		 */	
		public function __construct($path, array $default,array $rule = null) 
		{
			$this->Path = $path;
			$this->setDefault($default);
			$this->setRule(new Rule( $rule));

		}
		
		/**
		 * This is method getPath
		 *
		 * @return mixed This is the return value description
		 *
		 */	
		public function getPath()
		{
			return $this->Path;
		}
		
		/**
		 * This is method setRule
		 *
		 * @param IRule $rule This is a description
		 * @return mixed This is the return value description
		 *
		 */
		private function setRule(IRule $rule)
		{
			$this->Rule = $rule->getRule();
		}
		
		
		
		/**
		* Route::setDefault()
		* @param mixed $default
		* @return
		*/
		private function setDefault($default)
		{
			$this->Default = $default;
		}
		
		/**
		 * This is method getDefault
		 *
		 * @return mixed This is the return value description
		 *
		 */
		public function getDefault()
		{
			return $this->Default;
		}
		
		/**
		 * This is method expression
		 *
		 * @param mixed $expression This is a description
		 * @return mixed This is the return value description
		 *
		 */
		private  function expression($expression)
		{
			
			
			if(in_array($expression[1],$this->Rule)	== true)
			{
				return preg_replace('#:([\w]++)#', '(?P<\1>'.$this->Rule[$expression[1]].')', $expression[0]);
			}
			return preg_replace('#:([\w]++)#', '(?P<\1>[^\/]+)', $expression[0]);
			
		}
		
		private	function parseUrlTagsRecursive(array $input = null)
		{
			
			if(isset($this->Rule[$input[1]])== true)
			{
				
				return  sprintf("(?:(?P<%s>%s))",$input[1],$this->Rule[$input[1]]);
				
			}
			
			return  sprintf("(?:(?P<%s>[^/]*))",$input[1]);
			
		}

		public function getUrlSchema()
		{

			$regex = "#\{(.*?)({(.*?))?\}#";//"#{((?:[^{]|\[(?!/?}])|(?R))+)\}#";
			
			$expression = str_replace("/","/?",$this->Path); //str_replace(['/','/{'],[')?/(','/{'] ,$this->Path);
			
			$expression = preg_replace_callback($regex, array($this,'parseUrlTagsRecursive'), $expression);

			$expression = '#('.$expression.'?)#';

			return $expression;
		}
		

		/**
		 * This is method getFormat
		 *
		 * @return mixed This is the return value description
		 *
		 */	
		public function getFormat()
		{
			$expression = preg_replace('#[.\\+*?[^\\]$=!|]#', '\\\\$0', $this->Path);
			
			if(strpos($expression ,'(')!==FALSE )
			{
				$expression = str_replace(array('(',')'),array('(?:',')?') ,$expression );
			}
			
			$expression = preg_replace_callback('#\{((?:[^{]|\{(?!/?}})|(?R))+)\}#', array($this, "expression"),$expression);
			
			$expression = '#^' . $expression . '$#';

			return $expression;
		}
		
		
	}

?>