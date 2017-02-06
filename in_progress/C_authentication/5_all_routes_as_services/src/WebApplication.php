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
use Itb\Controller\MainController;
use Itb\Controller\AdminController;
use Itb\Controller\UserController;

class WebApplication extends Application
{
    const DEV = 0;
    const PROD = 1;

    public function __construct(int $environment)
    {
        parent::__construct();
        
        // setup Service controller provider
        $this->register(new Provider\ServiceControllerServiceProvider());


        $this->setupSessions();
        $this->setupTwig();


        $this->addRoutes();

        // environment setup
        if(self::DEV == $environment){
            $this['debug'] = true;
        } else {
            // neatly handle errors and exceptions with controllers
            $this->handleErrorsAndExceptions();
        }
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

        //==============================
        // controllers as a service
        //==============================
        $this['main.controller'] = function() { return new MainController($this);   };
        $this['matt.controller'] = function() { return new MattController($this);   };
        $this['user.controller'] = function() { return new UserController($this);   };
        $this['admin.controller'] = function() { return new AdminController($this);   };

        //==============================
        // now define the routes
        //==============================

        // -- main --
        $this->get('/', 'main.controller:indexAction');
        $this->get('/about','main.controller:aboutAction');
        $this->get('/iceCream/{flavour}', 'main.controller:iceCreamAction');
        $this->get('/makeError',  'main.controller:makeErrorAction');

        // -- matt --
        $this->get('/matt', 'matt.controller:indexAction');
        $this->get('/matt/{name}', 'matt.controller:nameAction');

        // ------ login routes GET ------------
        $this->get('/login', 'user.controller:loginAction');
        $this->get('/logout', 'user.controller:logoutAction');

        // ------ login routes POST (process submitted form)     ------------
        $this->post('/login', 'user.controller:processLoginAction');

        // ------ SECURE PAGES ----------
        $this->get('/admin',  'admin.controller:indexAction');
        $this->get('/admin/codes',  'admin.controller:codesAction');

    }


    public function handleErrorsAndExceptions ()
    {
        ErrorHandler::register();

        //register an error handler
        $this->error(function (\Exception $e, $code ) {

            //return your json response here
            $errorController = new ErrorController();
            $errorMessage = $e->getMessage();
            return $errorController->errorAction($this, $errorMessage);
        });
    }

}