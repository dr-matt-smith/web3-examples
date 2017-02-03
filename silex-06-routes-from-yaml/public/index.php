<?php

//----------- includes -----------------
require_once __DIR__.'/../vendor/autoload.php';

//----------- create 'app' object ---------
$app = new Itb\Application();

// run the application
$app->run();