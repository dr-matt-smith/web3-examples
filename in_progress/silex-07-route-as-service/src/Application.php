<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 15:52
 */

namespace Itb;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

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

        // setup Service controller provider
        $this->app->register(new \Silex\Provider\ServiceControllerServiceProvider());


        $this->setupTwig();
//        $this->setupMonolog();

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

        // hello routes
        $this->app->get('/hello',        'Itb\HelloController::indexAction');
        $this->app->get('/hello/{name}', 'Itb\HelloController::nameAction');

        // login routes
        $this->app->get('/login',        'Itb\LoginController::loginAction');


        //==============================
        // controller as a service
        //==============================
        $this->app['matt.controller'] = function(\Silex\Application $app) {
            return new MattController($app);
        };

        $this->app->get('/matt/', 'matt.controller:indexAction');
        $this->app->get('/matt/{name}', 'matt.controller:nameAction');

    }

}