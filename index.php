<?php

include_once 'settings.php';

session_start();

function __autoload($name)
{
	include_once str_replace("\\", DIRECTORY_SEPARATOR, $name) . '.php';
}

$app = new Core\App(new Core\Request($_GET, $_POST, $_SERVER));
$app->go();
