<?php
// autoloader& other functions to include
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/utility/helperFunctions.php';

// my settings
// ------------
$myTemplatesPath = __DIR__ . '/../templates';

// setup Twig
// ------------
$loader = new Twig_Loader_Filesystem($myTemplatesPath);
$twig = new Twig_Environment($loader);

// setup Silex
// ------------
$app = new Silex\Application();

// register Twig with Silex
// -------------------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $myTemplatesPath
));


//-------------------------------------------
// map routes to controller class/method
//-------------------------------------------


$app->get('/',      controller('Hdip\Controller', 'main/index'));
$app->get('/list',      controller('Hdip\Controller', 'main/list'));
$app->get('/show/',  controller('Hdip\Controller', 'main/showMissingId'));
$app->get('/show/{id}',  controller('Hdip\Controller', 'main/show'));

$app->get('/hello',  controller('Hdip\Controller', 'demo/hello'));
$app->get('/search',  controller('Hdip\Controller', 'demo/search'));


// go - process request and decide what to do
//---------------------------------------------

$app->run();
