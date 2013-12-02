<?php
namespace OrionMvc;

class  HttpValueCollection extends NameValueCollection
{

    public	function __construct(HttpValueCollection $collection) 
	{
		//parent::__construct(array_merge((array)$this,(array)$array), \ArrayObject::ARRAY_AS_PROPS);
		
		for ($i = 0; $i < $collection->count(); $i++)
		{
			
			$name = $collection->GetKey($i);
			$obj2 =$collection->Get($name);
			$this->Set($name,$collection);
			$this->Add($name,$obj2);
		}

		
		return $this;

	}
	
	
	

	/**
     * This is method Add
     *
     * @param mixed $name This is a description
     * @param mixed $value This is a description
     * @return mixed This is the return value description
     *
     */
	function Add($name,$value)
	{
		if(is_null($name))
		{
			$this->Add(null,$value);
		}else
		{
			$this->Add($name,$value);
		}
	}
	/**
     * This is method AddCookie
     *
     * @param HttpCookieCollection $c This is a description
     * @return mixed This is the return value description
     *
     */	
	function AddCookie(HttpCookieCollection $c)
	{
		$Count = $c->count();
		for($i = 0; $i<$Count; $i++)
		{
			$cookie = $c->Get($i);
			
		}
	}
	
	function Has($name)
	{
		return $this->offsetExists($name);
	}
	
	function Remove($name)
	{
		return	$this->Remove($name);
	}
	
	function Get($name)
	{
		return $this->Get($name);
	}
	
	public function FillFromString($string,$urlencode = true)
	{
		$num = ( $string != null )? strlen($string):0;
		
		for($i = 0; $i<$num;$i++)
		{
			$startIndex = $i;
			$num4=-1;
			while($i<$num)
			{
				$ch =$string[$i];
				if($ch == '=')
				{
					if($num4 < 0)
					{
						$num4 = $i;	
					}
				}
				else if($ch == '&')
				{
					break;
				}
				$i++;
				$str = null;
				$str2 = null;
				if($num4 >=0 )
				{
					$str = substr($string,$startIndex,($num4-$startIndex));
					$str2 = substr($string,($num4+1),($i-$num4)-1);
				}
				else
				{
					$str2 = substr($string,$startIndex,$i-$startIndex);
				}
				if($urlencode)
				{
					$this->Add(urldecode($str),urldecode($str2));
				}
				else
				{
					$this->Add($str,$str2);
				}
				
				if( $i == ($num -1 ) && ($string[$i] == '&' ) )
				{
					$this->Add(null,"" );
				}
			}
		}
	}
    
    public function MakeReadOnly()
    {
        $this->isReadOnly = true;
    }
    
    public function MakeReadWrite()
    {
        $this->isReadOnly = false;
    }
	
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
	
	public function __get($name)
	{
        if($this->Has($name))
        {
            return $this->offsetGet($name);
        }
        return null;
    }
	
	function ToString($urlencoded)
	{
		
	}
	
	public function __ToString()
	{
		return $this->ToString(true);
	}
    
    
}
?>