<?php 
session_start();

include_once("includes/config.php");

$requestPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$requestParts = preg_split('@/@', $requestPath, NULL, PREG_SPLIT_NO_EMPTY);

$controllerName = DEFAULT_CONTROLLER;
if(count($requestParts) > 0)
{
	$controllerName = strtolower($requestParts[0]);
	if(!preg_match("/^[a-zAQ-Z0-9_]+$/", $controllerName)) {
		die("Invalid controller name.");
	}
}

$actionName = DEFAULT_ACTION;
if(count($requestParts) > 1) {
	$actionName = strtolower($requestParts[1]);
	if(!preg_match("/^[a-zAQ-Z0-9_]+$/", $actionName)) {
		die("Invalid action name.");
	}
}

$params = array();
if(count($requestParts) > 2) {
	$params = array_splice($requestParts, 2);
}

$controllerClassName = ucfirst($controllerName) . "Controller";
if(class_exists($controllerClassName)) {
	$controller = new $controllerClassName($controllerName, $actionName);
	if(method_exists($controller, $actionName)) {
		call_user_func_array(array($controller, $actionName), $params);
	}
	else {
		die("Cannot find action '" . $actionName 
			."' in controller '" . $controllerClassName);
	}
}
else {
	$controllerFileName = "controllers/" . $controllerClassName . ".php";
	die("Cannot find controller: " . $controllerFileName);
}

function __autoload($class_name) {
	if(file_exists("controllers/$class_name.php")) {
		include "controllers/$class_name.php";
	}
	if(file_exists("models/$class_name.php")) {
		include "models/$class_name.php";
	}
}