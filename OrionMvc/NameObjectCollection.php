<?php
namespace OrionMvc;
/**
 * NameObjectCollection short summary.
 *
 * NameObjectCollection description.
 *
 * @version 1.0
 * @author can
 */
class NameObjectCollection extends \ArrayObject
{
    protected $IsReadOnly;
    
    public function __construct(array $data = null)
	{
        parent::__construct($this,\ArrayObject::STD_PROP_LIST);

    }
    
    public function Each($Callback)
	{
		$iterator = $this->getIterator();
		while($iterator->valid())
		{
			$Callback($iterator->current());
			$iterator->next();
			
		}
		
	}
	
	public function MakeReadOnly()
	{
		$this->isReadOnly = true;
	}
	
	public function Without(/** parameter */)
	{
		$Args = func_get_args();
		return array_values(array_diff($this,$Args));
	}
	
	public function Firts()
	{
		return $this[0];
	}
	
	public function IndexOf($index)
	{
		return array_search($index,$this);
	}
	
	public function Last()
	{
		
		return $this[count($this)-1];
	}
	
	/**
     * This is method AddCollection
     *
     * @param NameValueCollection $Collection This is a description
     * @return mixed This is the return value description
     *
     */	
	public function AddCollection(NameValueCollection $Collection)
	{
		if($Collection == null)
		{
			throw OrionException::Handler(new ErrorException(" Null Argument Exception collection"));
		}
		$count = $Collection->count();
		for($i = 0; $i<$count; $i++)
		{
			$key = $Collection->GetKey($i);
			$values = $Collection->GetValue($i);
		}
		
	}
	/**
     * This is Name Value Collection Add
     *
     * @param mixed $name 
     * @param mixed $value
     * @return
     *
     */	
	public function BaseAdd($name,$value)
	{
		if(is_null($name))
		{
			$this->offsetSet(null,$value);
		}else
		{
			$this->offsetSet($name,$value);
		}
	}

	public function BaseGet($name)
	{
        if( $this->offsetExists($name)){
            return $this->offSetGet($name);
        }
        else
        {
            return null;
        }
    }

	public function GetIndex($index)
	{
		if(is_int($index))
		{
			return $this[$index];
		}
	}

	public function GetKey($index)
	{
		
		$iterator = $this->getIterator();
		if($iterator->valid()){
			$iterator->seek($index);
			return $iterator->key();
		}
		
	}
    
    
	public function GetValue($index)
	{
		$iterator = $this->getIterator();
		if($iterator->valid())
		{
			$iterator->seek($index);
			$iterator->current();
		}
	}
	
	public function GetAllKeys()
	{
		return $this->getArrayCopy();
	}
	
	public function Remove($name)
	{
		$this->offsetUnset($name);
		
	}
	
	public function BaseSet($name,$value)
	{
		if($this->IsReadOnly)
		{
			throw OrionException::Handler(new ErrorException("Collection Read Only"));
		}
		$list = new \ArrayObject(array(1));
		$list->offsetSet(null,$value);
		$this->BaseAdd($name,$list);
	}
    
    public function BaseClear()
    {
        reset($this);
        return true;
    }

	public function Clear()
	{
		if($this->isReadOnly)
		{
			throw OrionException::Handler(new ErrorException("Collection Read Only"));
		}
		unset($his);
	}
	
	
	
	public function __set($name,$value)
	{
		if(is_null($name))
		{
			$this->offsetSet(null,$value);
		}else
		{
			$this->offsetSet($name,$value);
		}
	}
    
    //public static function __callStatic($name, $obj)
    //{
    //   //\Application::Debug($name,$obj);
    //}
    
    
}
