<?php
 //Application Start
 



define('ABSPATH',   dirname(realpath(__FILE__)). DIRECTORY_SEPARATOR);


require_once(ABSPATH."OrionMvc".DIRECTORY_SEPARATOR."OrionException.php");

require_once(ABSPATH."OrionMvc".DIRECTORY_SEPARATOR."Autoloader.php");

require_once(ABSPATH."Configration".DIRECTORY_SEPARATOR."Config.php");

require_once(ABSPATH.'Application.php');

$Exception = OrionMvc\OrionException::Instance();

$Exception->Register();

$Load = new OrionMvc\Autoloader;

$App = \Application::GetInstance();



$App->Event->add('Orion.onLoad',$Load);

$App->Event->add('Orion.Exception',$Exception);

$App->Event->add("Orion.onShutDown",function(){ echo "simple test";});

$Context = new OrionMvc\HttpContext(new OrionMvc\HttpRequest,new OrionMvc\HttpResponse ); // listen server

$App->Event->add('Orion.Context',$Context);



$App->Configration = new Configration\Config();

$App->Dispatcher->Dispatch($Context);

$App->Event->get("Orion.onShutDown");


?>