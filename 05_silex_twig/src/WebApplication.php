<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 15:52
 */

namespace Itb;

use Silex\Application;

class WebApplication extends Application
{
    // location of Twig templates
    private $myTemplatesPath = __DIR__ . '/../templates';

    public function __construct()
    {
        parent::__construct();

        $this['debug'] = true;
        $this->setupTwig();
        $this->addRoutes();
    }

    public function setupTwig()
    {
        // register Twig with Silex
        // ------------
        $this->register(new \Silex\Provider\TwigServiceProvider(),
            [
                'twig.path' => $this->myTemplatesPath
            ]
        );
    }

    public function addRoutes()
    {
        //----------- map 'routes' to controller 'actions' -----------
        // main routes
        $this->get('/',        'Itb\MainController::indexAction');
        $this->get('/contact', 'Itb\MainController::contactAction');
    }
}