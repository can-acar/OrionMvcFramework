<?php
namespace OrionMvc;
/**
 * class View
 *
 * Description for class View
 *
 * @author:
*/
class View implements IView  {

	/**
	 * View constructor
	 *
	 * @param 
	 */
	public function __construct(){}
	
	
	public $ViewData=array();
	
	
	public function Render(AbstractController $controller,$path,$view)
	{
		
		$level = ob_get_level();
		
		$this->ViewData = $controller->ViewData->GetData();

		$this->__f = \Application::FindFile($view,ABSPATH.'View'.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR); 
		
		if (file_exists($this->__f) == false) {
			$_m = sprintf("<p>%s %s template not found!</p>",$path,$view);
			echo($_m);
			
			return false;
		}
		
		ob_start();
		
		
		if($this->ViewData)
		{
			extract($this->ViewData,EXTR_SKIP | EXTR_REFS);
		}
		
		
		
	
		//extract($this->ViewData,EXTR_SKIP | EXTR_REFS);
		try{
			 
			require($this->__f);

		}catch(\Exception $e)
		{
			
			while (ob_get_level() > $level)
			{
                ob_end_clean();
            }
			
			throw	OrionException::Handler(new ErrorException("View Rendering Exception!."));
			
			
		}

		return ob_get_clean();
		
	
	}
	
		
	public function __destruct()
	{
		unset($this);
		
	}
}

?>