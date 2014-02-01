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

			OrionMvc\Router::Connect('default','{controller}/{action}/{id}',
				['controller'=>'Home',
					'action'=>'Index'],
					['id'=>'\d+']);
            OrionMvc\Router::Connect('about','about',
            ['controller'=>'Home',
                    'action'=>'About']);
			/*OrionMvc\Router::Connect('search','search/{text}?{query}',
				['controller'=>'Search',
						'action'=>'Index'],
					["text"=>'([a-zA-Z_-]+)',
						"query"=>OrionMvc\Router::QUERY_STRING_PARAMS]);
			
		




			
			OrionMvc\Router::Connect('default2','{controller}/{action}/{id}',
				['controller'=>'Home',
						'action'=>'Index'],
					['id'=>'\d+',
						'text'=>'([a-zA-Z]+)']);*/

            //OrionMvc\Router::Connect('default3','{controller}/{action}/{content}/{id}',
            //    ['controller'=>'Home',
            //            'action'=>'Index'],
            //        ['id'=>'\d+',
            //            'text'=>'([a-zA-Z]+)']);
						
		/*	
			OrionMvc\Router::Connect('default4','/{query}',
				['controller'=>'Home',
						'action'=>'Query'],
					['query'=>OrionMvc\Router::QUERY_STRING_PARAMS]);	*/		

		}	
	}				



	
?>