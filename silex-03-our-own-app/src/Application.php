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

        $this->addRoutes();

        $this->app->run();
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

    }

}