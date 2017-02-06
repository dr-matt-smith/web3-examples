<?php
// autoloader& other functions to include
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';


//----------- create 'app' object ---------
$app = new Hdip\Application();

// run the app!
$app->run();
