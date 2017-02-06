<?php
// autoloader& other functions to include
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';

// load all our Silex / Twig setup etc.
require_once __DIR__ . '/../app/config.php';

//-------------------------------------------
// map routes to controller class/method
//-------------------------------------------

$app->get('/',      'Hdip\\Controller\\MainController::indexAction');
$app->get('/about',      'Hdip\\Controller\\MainController::aboutAction');
$app->get('/iceCream/{flavour}',      'Hdip\\Controller\\MainController::iceCreamAction');

// ------ SECURE PAGES ----------
$app->get('/admin',  'Hdip\\Controller\\AdminController::indexAction');
$app->get('/admin/codes',  'Hdip\\Controller\\AdminController::codesAction');

// ------ login routes GET ------------
$app->get('/login',  'Hdip\\Controller\\UserController::loginAction');
$app->get('/logout',  'Hdip\\Controller\\UserController::logoutAction');

// ------ login routes POST (process submitted form)     ------------
$app->post('/login',  'Hdip\\Controller\\UserController::processLoginAction');


// go - process request and decide what to do
//---------------------------------------------

$app->run();
