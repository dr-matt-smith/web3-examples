<?php

//----------- includes -----------------
require_once __DIR__.'/../vendor/autoload.php';

//----------- create 'app' object ---------
use Itb\WebApplication;

//---- choose DEV or PROD -------
$environment = WebApplication::DEV;
//$environment = WebApplication::PROD;

//----- create applicaiton with DEV/PROD option
$app = new WebApplication($environment);

//---- run the router/dispatcher -------
$app->run();
