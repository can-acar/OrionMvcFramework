<?php
	namespace OrionMvc;
	/**
	 * class RouterCollection
	 *
	 * Description for class RouterCollection
	 *
	 * @author:
	*/
	class RouterCollection extends \ArrayObject  {
		
		
		/**
		 * This is variable Collection description
		 *
		 * @var $Collection Array; 
		 *
		 */
		//protected $Collection = array();
		/**
		 * RouterCollection constructor
		 *
		 * @param 
		 */
		public function __construct(){
			
			parent::__construct(array(), \ArrayObject::STD_PROP_LIST	);
			
		}


		public function Add($Key,$Value)
		{

			$this->offsetSet($Key,$Value);

		}

		public function Get()
		{
			return $this->getIterator();
		}

		
		public function GetController($Default)
		{
			$_Default = $this->offsetGet($Default);
			return $_Default;
		}

        public function __toString()
        {
            return "RouterCollection";
        }

	}

?>