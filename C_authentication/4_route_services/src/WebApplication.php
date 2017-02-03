<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 15:52
 */

namespace Itb;

use Silex\Application;
use Symfony\Component\Debug\ErrorHandler;
use Silex\Provider;

use Itb\Controller\MattController;
use Itb\Controller\ErrorController;
use Symfony\Component\Debug\Exception\SilencedErrorContext;

class WebApplication extends Application
{
    public function __construct()
    {
        parent::__construct();
        
        // setup Service controller provider
        $this->register(new Provider\ServiceControllerServiceProvider());

        $this['debug'] = true;


        $this->setupSessions();
        $this->setupTwig();

//        $this->handleErrorsAndExceptions();

        // do this after other services
//        $this->setupServies();


        $this->addRoutes();
    }

    public function setupServies()
    {
        $this->register(new Provider\HttpFragmentServiceProvider());
        $this->register(new Provider\ServiceControllerServiceProvider());

    }

    public function setupSessions()
    {
        $this->register(new Provider\SessionServiceProvider());
    }

    public function setupTwig()
    {
        // location of Twig templates
        $myTemplatesPath = __DIR__ . '/../templates';

        // register Twig with Silex
        // ------------
        $this->register(new Provider\TwigServiceProvider(),
            [
                'twig.path' => $myTemplatesPath
            ]
        );

    }

    public function addRoutes()
    {
        // map routes to controller class/method
        //-------------------------------------------

        $this->get('/',      'Itb\\Controller\\MainController::indexAction');
        $this->get('/about',      'Itb\\Controller\\MainController::aboutAction');
        $this->get('/iceCream/{flavour}',      'Itb\\Controller\\MainController::iceCreamAction');

        // ------ SECURE PAGES ----------
        $this->get('/admin',  'Itb\\Controller\\AdminController::indexAction');
        $this->get('/admin/codes',  'Itb\\Controller\\AdminController::codesAction');

        // ------ login routes GET ------------
        $this->get('/login',  'Itb\\Controller\\UserController::loginAction');
        $this->get('/logout',  'Itb\\Controller\\UserController::logoutAction');

        // ------ login routes POST (process submitted form)     ------------
        $this->post('/login',  'Itb\\Controller\\UserController::processLoginAction');

        // ------ login routes POST (process submitted form)     ------------
        $this->get('/makeError',  'Itb\\Controller\\MainController::makeErrorAction');



        //==============================
        // controller as a service
        //==============================


        //==============================
        // controller as a service
        //==============================
        $this['matt.controller'] = function() { return new MattController($this);   };

        $this->get('/matt', 'matt.controller:indexAction');
        $this->get('/matt/{name}', 'matt.controller:nameAction');
    }


    public function handleErrorsAndExceptions ()
    {
        ErrorHandler::register();

        //register an error handler
        $app = $this;
        $this->error(function (\Exception $e, $code ) use ($app) {

            //return your json response here
            $errorController = new ErrorController();
            $errorMessage = $e->getMessage();
            return $errorController->errorAction($app, $errorMessage);
        });
    }

}