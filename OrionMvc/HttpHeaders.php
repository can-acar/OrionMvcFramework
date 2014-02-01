<?php
	namespace OrionMvc;

	/**
	 * Summary of HttpHeaders
	 */
	class HttpHeaders extends NameValueObject
	{

		/**
		 * Summary of __construct
		 * @param array $array 
		 */
		public  function __construct(array $array = null) 
		{
			parent::__construct($array, \ArrayObject::ARRAY_AS_PROPS);
		}

		/**
		 * Summary of Add
		 * @param mixed $name 
		 * @param mixed $value 
		 */
		public  function Add($name,$value)
		{
			if(is_null($name))
			{
				$this->offSetSet(null,$value);
			}else
			{
				$this->offSetSet($name,$value);
			}
		}
		/**
		 * Summary of Has
		 * @param mixed $name 
		 * @return mixed
		 */
		public function Has($name)
		{
			return $this->offsetExists($name);
		}
		/**
		 * Summary of Remove
		 * @param mixed $name 
		 */
		public function Remove($name)
		{
			$this->offsetUnset($name);
		}
		/**
		 * Summary of Get
		 * @param mixed $name 
		 * @return mixed
		 */
		public function Get($name)
		{
			return $this->offsetGet($name);
		}
		/**
		 * Summary of __set
		 * @param mixed $Name 
		 * @param mixed $Value 
		 */
		public function __set($Name,$Value)
		{
			
			if(is_null($Name))
			{
				$this->offsetSet(null,$Value);
			}else
			{
				$this->offsetSet($Name,$Value);
			}
		}
		/**
		 * Summary of __get
		 * @param mixed $name 
		 * @return mixed
		 */
		public function __get($name)
		{
			return $this->offsetGet($name);
		}
		/**
		 * Summary of __ToString
		 * @return mixed
		 */
		public function __ToString()
		{
			return "Array";
		}
		
		
	}
?>