<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 15:52
 */

namespace Itb;


class Application
{
    /**
     * @var \Silex\Application
     */
    private $app;
    
    public function __construct()
    {
        //----------- create 'app' object ---------
        $this->app = new \Silex\Application();

        $this->setupTwig();
        $this->setupMonolog();
        $this->addRoutes();
    }

    public function run()
    {
        $this->app->run();
    }

    public function setupTwig()
    {
        // location of Twig templates
        $myTemplatesPath = __DIR__ . '/../templates';

        // register Twig with Silex
        // ------------
        $this->app->register(new \Silex\Provider\TwigServiceProvider(),
            [
                'twig.path' => $myTemplatesPath
            ]
        );

    }

    public function setupMonolog()
    {
        // location of Twig templates
        $myLoggingPath = __DIR__ . '/../logs/development.log';

        $this->app->register(new \Silex\Provider\MonologServiceProvider(),
            [
                'monolog.logfile' => $myLoggingPath
            ]
        );
    }

    public function addRoutes()
    {
        //----------- map 'routes' to controller 'actions' -----------
        // main routes
        $this->app->get('/',        'Itb\MainController::indexAction');
        $this->app->get('/contact', 'Itb\MainController::contactAction');

        $this->app['monolog']->debug('adding GET route /');
        $this->app['monolog']->debug('adding GET route /contact');
    }

}