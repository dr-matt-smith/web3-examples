<?php
// autoloader& other functions to include
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';


//----------- create 'app' object ---------
$app = new Itb\WebApplication();

// run the app!
$app->run();
