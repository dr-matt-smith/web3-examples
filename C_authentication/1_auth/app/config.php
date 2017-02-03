<?php

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
$app['debug'] = true;

// register Session provider with Silex
// -------------------------
$app->register(new Silex\Provider\SessionServiceProvider());

// register Twig with Silex
// -------------------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
'twig.path' => $myTemplatesPath
));

/*
// register DEBUG toolbar (after all other services)
// -------------------------
$app->register(new Provider\HttpFragmentServiceProvider());
$app->register(new Provider\ServiceControllerServiceProvider());
$app->register(new Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../cache/profiler',
    'profiler.mount_prefix' => '/_profiler', // this is the default
));
*/