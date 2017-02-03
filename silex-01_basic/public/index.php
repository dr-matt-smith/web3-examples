<?php

//----------- includes -----------------
require_once __DIR__ . '/../vendor/autoload.php';

//----------- create 'app' object ---------
$app = new Silex\Application();

//----------- map 'routes' to controller 'actions' -----------

//
// action index for route:   /
//
$app->get('/', function(){
    return 'Hello world';
});

//
// action contact for route:   /contact
//
$app->get('/contact', function(){
    return 'Contact Us as: 012 885 1098 or email to: info@itb.ie';
});

//
// action hello $name for route:   /hello/{name}
//
$app->get('/hello/{name}', function($name) use($app) {
    return 'Hello '.$app->escape($name);
});

//---------- go - process requrest and decide what to do -------------
$app->run();
