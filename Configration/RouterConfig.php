<?php
namespace Configration;
use OrionMvc;
//$Router = new Orion\Router();
//{controller}{action}{id}{text} => /controller/action/id/text
//{controller}/{action}/{id}/{text}?:action=deneme
//TODO: eğer ? den sonra bir parametre girilip QueryStringParametresi olarak tanımlanırsa query parametresini  yakalar.
//{:controller{/:action{/:id{/:text}}}}
//'(:controller(/:action(/:id(/:text))))',
class RouterConfig
{
	
	
	
	public function __construct(){

		OrionMvc\Router::IgnoreRoute();

		OrionMvc\Router::Connect('search','search/{text}?{query}',
				['controller'=>'Search',
					'action'=>'Index'],
				["text"=>'([a-zA-Z_-]+)',
					"query"=>OrionMvc\Router::QUERY_STRING_PARAMS]);
					
	     OrionMvc\Router::Connect('about','/about',
				 ['controller'=>'Home',
				 'action'=>'About']
		 );


		OrionMvc\Router::Connect('default2','/?{query}',
				['controller'=>'Home',
					'action'=>'Index'],
				['query'=>OrionMvc\Router::QUERY_STRING_PARAMS]);
		
		OrionMvc\Router::Connect('default','{controller}/{action}/{content}/{id}',
				['controller'=>'Home',
					'action'=>'Index'],
				['id'=>'\d+',
					'text'=>'([a-zA-Z]+)']);

	}	
}				



				
?>