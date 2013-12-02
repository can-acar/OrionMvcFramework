<?php
namespace Application\Search;
use OrionMvc;
/**
 * class SearchController
 *
 * Description for class SearchController
 *
 * @author:
*/
class SearchController extends OrionMvc\Controller
{

	/**
	 * SearchController constructor
	 *
	 * @param 
	 */
	public function Index()
	{
		var_dump($this->Request->QueryStringParams);
		//var_dump($this->Request);
	}
}

?>