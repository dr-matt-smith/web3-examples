<?php

//----------- includes -----------------
require_once __DIR__.'/../vendor/autoload.php';

//----------- create 'app' object ---------
$app = new Silex\Application();
$app['debug'] = true;

//----------- map 'routes' to controller 'actions' -----------
// main routes
$app->get('/',        'Itb\MainController::indexAction');
$app->get('/contact', 'Itb\MainController::contactAction');

// hello routes
$app->get('/hello',        'Itb\HelloController::indexAction');
$app->get('/hello/{name}', 'Itb\HelloController::nameAction');

//---------- go - process request and decide what to do -------------
$app->run();
