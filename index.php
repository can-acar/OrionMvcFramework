<?php

define('ABSPATH',   dirname(realpath(__FILE__)). DIRECTORY_SEPARATOR);


require_once(ABSPATH."OrionMvc".DIRECTORY_SEPARATOR."Autoloader.php");

require_once(ABSPATH."OrionMvc".DIRECTORY_SEPARATOR."OrionException.php");

require_once(ABSPATH."Configration".DIRECTORY_SEPARATOR."Config.php");

require_once(ABSPATH.'Application.php');

$Load      = new OrionMvc\Autoloader();

$Exception = OrionMvc\OrionException::Instance();

$Exception->Register();

$App       = \Application::GetInstance();


$App->Dispatcher->Dispatch($App->Context,$App);



?>