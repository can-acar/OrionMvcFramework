<?php
namespace OrionMvc;
/**
 * This is interface IView
 *
 */
interface IView
{
	/**
	 * This is function Render
	 *
	 * @param IController $controller This is a description
	 * @param mixed $view This is a description
	 * @return mixed This is the return value description
	 *
	 */	
	public function Render(AbstractController $Controller,$Path,$View);
}
