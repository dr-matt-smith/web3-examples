<?php
// autoloader& other functions to include
// ---------------------------------------
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/utility/helperFunctions.php';

use Silex\Provider;

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

// start session
//$app->before(function ($request) { $request->getSession()->start(); });

//$app->before(function ($request) { $request->getSession()->start(); });

// register Session provider with Silex
// -------------------------
$app->register(new Silex\Provider\SessionServiceProvider());


// register Twig with Silex
// -------------------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $myTemplatesPath
));

// register DEBUG toolbar (after all other services)
// -------------------------
$app->register(new Provider\HttpFragmentServiceProvider());
$app->register(new Provider\ServiceControllerServiceProvider());
$app->register(new Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../cache/profiler',
    'profiler.mount_prefix' => '/_profiler', // this is the default
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

// ------ SECURE PAGES ----------
$app->get('/admin',  controller('Hdip\Controller', 'admin/index'));

// ------ login routes GET ------------
$app->get('/login',  controller('Hdip\Controller', 'user/login'));
$app->get('/logout',  controller('Hdip\Controller', 'user/logout'));

// ------ login routes POST (process submitted form)     ------------
$app->post('/login',  controller('Hdip\Controller', 'user/processLogin'));


// go - process request and decide what to do
//---------------------------------------------

$app->run();
