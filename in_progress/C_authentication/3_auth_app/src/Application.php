<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 15:52
 */

namespace Hdip;

use Silex\Application as Silex_Application;
use Symfony\Component\Debug\ErrorHandler;

class Application extends Silex_Application
{
    public function __construct()
    {
        parent::__construct();

        $this['debug'] = true;

        $this->addRoutes();

        $this->setupSessions();
        $this->setupTwig();

        $this->handleErrorsAndExceptions();
    }


    public function setupSessions()
    {
        $this->register(new \Silex\Provider\SessionServiceProvider());
    }

    public function setupTwig()
    {
        // location of Twig templates
        $myTemplatesPath = __DIR__ . '/../templates';

        // register Twig with Silex
        // ------------
        $this->register(new \Silex\Provider\TwigServiceProvider(),
            [
                'twig.path' => $myTemplatesPath
            ]
        );

    }

    public function addRoutes()
    {
        // map routes to controller class/method
        //-------------------------------------------

        $this->get('/',      'Hdip\\Controller\\MainController::indexAction');
        $this->get('/about',      'Hdip\\Controller\\MainController::aboutAction');
        $this->get('/iceCream/{flavour}',      'Hdip\\Controller\\MainController::iceCreamAction');

        // ------ SECURE PAGES ----------
        $this->get('/admin',  'Hdip\\Controller\\AdminController::indexAction');
        $this->get('/admin/codes',  'Hdip\\Controller\\AdminController::codesAction');

        // ------ login routes GET ------------
        $this->get('/login',  'Hdip\\Controller\\UserController::loginAction');
        $this->get('/logout',  'Hdip\\Controller\\UserController::logoutAction');

        // ------ login routes POST (process submitted form)     ------------
        $this->post('/login',  'Hdip\\Controller\\UserController::processLoginAction');

        // ------ login routes POST (process submitted form)     ------------
        $this->get('/makeError',  'Hdip\\Controller\\MainController::makeErrorAction');


    }


    public function handleErrorsAndExceptions ()
    {
        ErrorHandler::register();

        //register an error handler
        $app = $this;
        $this->error(function (\Exception $e, $code ) use ($app) {

            //return your json response here
            $errorController = new \Hdip\Controller\ErrorController();
            $errorMessage = $e->getMessage();
            return $errorController->errorAction($app, $errorMessage);
        });

        /*
         * old way

            $app = $this;
        $this->error(function (\Exception $e, string $code) use ($app) {
            $errorController = new \Hdip\Controller\ErrorController();
            return $errorController->errorAction($app, $code);
        });


         */
    }

}