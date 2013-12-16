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

$Context = new OrionMvc\HttpContext(new OrionMvc\HttpRequest,new OrionMvc\HttpResponse ); // listen server

$App->Configration = new Configration\Config($App);

$App->Dispatcher->Dispatch($Context,$App);

$App->Event->modul->onActionResult($App);
\Application::ConsoleLog($App->Event->modul);
?>