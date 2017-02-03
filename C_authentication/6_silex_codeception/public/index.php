<?php
// autoloader& other functions to include
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';

//----------- create 'app' object ---------
use Itb\WebApplication;

$environment = WebApplication::DEV;
//$environment = WebApplication::PROD;

$app = new WebApplication($environment);

// run the app!
$app->run();
