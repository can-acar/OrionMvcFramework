<?php

/**
 * This is class Application
 * @package OrionMvc
 * @license MIT.
 * @copyright 2013
 * @version 1.0
 */
use OrionMvc\Exception as Exception;
class Application
{
	
	
	
	public $Path;


	/**
     * This is variable ControllerFactory description
     *
     * @var mixed
     *
     */
	public  $ControllerFactory;

	/**
     * This is variable Instance description
     *
     * @var mixed
     *
     */
	public static  $Instance;

	/**
     * This is variable Router description
     *
     * @var mixed
     *
     */
	public $Router;

	/**
     * This is variable View description
     *
     * @var mixed
     *
     */
	public $View;
	
	/**
     * This is variable Session description
     *
     * @var mixed 
     *
     */	
	public $Session;
	
	/**
     * This is variable Dispatcher description
     *
     * @var mixed 
     *
     */
	
	public $Dispatcher;
	
	/**
     * This is variable Event description
     *
     * @var mixed 
     *
     */	
	public $Event;
	
	
	
	public $Configration;
	
	/**
     * This is method __construct
     *
     * @return mixed This is the return value description
     *
     */
	protected	function __construct()
	{
		return;
	}

	/**
     * This is method GetInstance
     *
     * @return mixed This is the return value description
     *
     */
	public static function GetInstance()
	{

		if (is_null( self::$Instance ))
		{
			self::$Instance = new static();
			self::$Instance->Initialize();
		}
		return self::$Instance;
	}


	/**
     * This is method Initialize
     *
     * @return mixed This is the return value description
     *
     */
	public	function Initialize()
	{
		try
		{

			$this->Session		 	 = new OrionMvc\Session();

			$this->Router			 = new OrionMvc\Router();
            
			$this->Event			 = new OrionMvc\EventDispatcher();

			$this->ControllerFactory = new OrionMvc\ControllerFactory();

			$this->View			     = new OrionMvc\View();
			
			$this->Dispatcher        = new OrionMvc\Dispatcher($this);

			
			return $this;

		}
        catch (Exception $e)
		{
			throw OrionException::Handler(new Exception\ErrorException("Application Initialize Error!."));
			
		}
		
	}

	
	/**
     * This is method LoadConfig
     *
     * @param mixed $configName This is a description
     * @return mixed This is the return value description
     *
     */
	public static function LoadConfig($configName)
	{
		$getConfig = func_get_args();
		
		foreach ($getConfig  as $config) {
			if(file_exists(self::FindFile($config)))
			{
				require_once(self::FindFile($config));
			}else
			{
				return false;

			}
		}
	}

	/**
     * This is method FindFile
     *
     * @param mixed $FileName
     * @param mixed $Path
     * @param mixed $Ext
     * @return file and real path;
     *
     */
	public static function FindFile($fileName,	$Path = ABSPATH)
	{
		$FilePath = null;
		try{
			
			$Files         = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($Path),\RecursiveIteratorIterator::CHILD_FIRST);
			$GetMatchFiles = new \RegexIterator($Files, sprintf('/\b%s.php\b/i',$fileName));
			
			foreach ($GetMatchFiles as $File)
			{
				if($File->isFile())
				{
					return $File->getRealPath();
				}
				$FilePath = $File->getRealPath();
			}
			
		}
		catch(\OrionMvc\Exception\UnexpectedValueException $e)
		{
			\OrionMvc\OrionException::Handler(new Exception\ErrorException("Sistem Belirtilen Yolu Bulamıyor :[{$FilePath}]",0,0,null,0,null));
			return false;
		}
		
	}
	
	protected $ExceptionHandler;
	public function ExceptionHandler(OrionMvc\OrionException $Handler)
	{
		$this->ExceptionHandler = $Handler;
	}
	
	
	public static function Debug(/**  any arguments */)
	{
		ob_start();
		
        
		if (func_num_args() === 0)
			return;
        
        $params = func_get_args();
        $output = array();
        
        foreach ($params as $var) {
			
            $output[] = '(' . gettype($var) . ') ' . htmlspecialchars(print_r($var,true));			
            
        }
        print(implode("", $output));	
        $str = ob_get_contents(); 
        ob_end_clean();			 	
        self::PretyDebug($str);	
        
		ob_end_clean();				
	}
	
	public static function ConsoleLog($data)
	{
 
		$_trace = debug_backtrace();
        ob_start();
        echo "<script>\r\n//<![CDATA[\r\nif(!console){var console={log:function(){}}}";
		$_file = ($_trace[0]['file']);
		$_line = ($_trace[0]['line']);
	
		
	
        $output    =    explode("\n", print_r($data, true)); 
        foreach ($output as $line)
		{ 
            if (trim($line)) { 
                $line    =    addslashes($line);
						
                echo "console.log(\"{$line}\");"; 
            } 
        } 
        echo "\r\n//]]>\r\n</script>"; 
        ob_end_flush();	
    }
	
	public static	function PretyDebug($in) 
	{ 
		$_trace = debug_backtrace();
        $captured = preg_split("/\r?\n/",$in);
        $output = array();
        $output[] = '<html>';
        $output[] = '<head>';
        $output[] = '<link href="../Theme/css/bootstrap.min.css" rel="stylesheet" media="screen">
						 <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
						 <link href="../Theme/css/theme.css" rel="stylesheet" media="screen">
						 <link href="../Theme/css/pygments.css" rel="stylesheet" media="screen">';
        $output[] = '</head>
						 <body>';
        $output[] = '<div class="container" style="margin-top: 50px;">
						 <div class="row">
						 <div class="col-lg-12">
						 <div class="panel panel-default">
						 <div class="panel-heading"> Debuging  <span class="s1"> [ '.$_trace[1]["file"].'] line = ['.$_trace[1]["line"].']</span></div>
						 <div class="panel-body">
						 <div class="highlight">';
        $output[] = '<pre>';
        $output[] = '<code class="html">'; 
        foreach($captured as $line)
        {
            
			$output[] = self::debug_colorize_string($line)."</br>";
			
        }
        $output[] = '</code>';
        $output[] = '</pre>';
        $output[] = '</div/>
						 </div>
						 </div>
						 </div>
						 </div>';
        $output[] = '</body>
						 </html>';
        print(implode("", $output));
        exit;	
    } 
	
	public static function debug_colorize_string($string) 
    { 
		
        $string = preg_replace('/\[(file)\]/i','[<strong> <span class="na">$1</span></strong> ]',$string);
        
        $string = preg_replace('/\[(line)\]/i','[<strong> <span class="mf">$1</span></strong> ]',$string);
        
        $string = preg_replace('/\[(function)\]/i','[<strong> <span class="nf">$1</span></strong> ]',$string);
        
        $string = preg_replace('/\[(class)\]/i','[<strong> <span class="na">$1</span></strong> ]',$string);
        
        $string = preg_replace('/\[(type)\]/i','[<strong> <span class="ss">$1</span></strong> ]',$string);
        
        $string = preg_replace('/\[(args)\]/i','[<strong> <span class="nt">$1</span></strong> ]',$string);
        
        $string = preg_replace("/\[(\w.*)\]/i", '[<strong> <span class="nv">$1</span></strong> ]', $string);
       
		$string = preg_replace("/\[(:private)\]/i", '', $string);

        $string = str_replace('Array','',$string);
        
		$string = str_replace('(object)','<span class="kt">(object)</span>',$string);
		
		$string = str_replace('(array)','<span class="kt">[array]</span>',$string);
		
        $string = str_replace('=>','<span class="s">=></span>',$string);
      
        
        return $string;
    } 
} 



?>