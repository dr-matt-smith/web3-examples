<?php
namespace Itb;

use Silex\Application;
use Silex\Provider;
use Symfony\Component\Debug\ErrorHandler;

class WebApplication extends Application
{
    // location of Twig templates
    private $myTemplatesPath = __DIR__ . '/../templates';

    public function __construct()
    {
        parent::__construct();

        // setup Session and Service controller provider
        $this->register(new Provider\SessionServiceProvider());
        $this->register(new Provider\ServiceControllerServiceProvider());

        $this->setupTwig();
        $this->addRoutes();

        // debug for 'dev' mode
        // $this['debug'] = true;

        // setup error handling for 'prod' mode
        $this->handleErrorsAndExceptions();
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

    public function addRoutes()
    {
        // map routes to controller class/method
        //-------------------------------------------

        //==============================
        // controllers as a service
        //==============================
        $this['main.controller'] = function() { return new MainController($this);   };
        $this['user.controller'] = function() { return new UserController($this);   };
        $this['admin.controller'] = function() { return new AdminController($this);   };

        //==============================
        // now define the routes
        //==============================

        // -- main --
        $this->get('/', 'main.controller:indexAction');
        $this->get('/contact','main.controller:contactAction');
        $this->get('/list','main.controller:listAction');


        // ------ login routes GET and POST ------------
        $this->get('/login', 'user.controller:loginAction');
        $this->post('/login', 'user.controller:processLoginAction');

        // ------ logout route GET ------------
        $this->get('/logout', 'user.controller:logoutAction');

        // ------ SECURE PAGES ----------
        $this->get('/admin',  'admin.controller:indexAction');
        $this->get('/admin/codes',  'admin.controller:codesAction');

    }
}