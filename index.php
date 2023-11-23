<?php

include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'show';

if($module != 'login'){
    session_start();
    if(!isset($_SESSION['id'])){
        $module = "login";
        $method = "form";
    }
}

$router->route($module, $method);
