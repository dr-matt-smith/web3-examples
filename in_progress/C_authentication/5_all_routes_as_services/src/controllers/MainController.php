<?php

namespace Itb\Controller;

use Itb\Model\DvdRepository;
use Itb\WebApplication;

class MainController extends Controller
{
    private $app;

    public function __construct(WebApplication $app)
    {
        parent::__construct($app);
        $this->app = $app;
    }
    
    // action for route:    /
    public function indexAction()
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($this->app);
        $argsArray = array(
            'username' => $username
        );

        // get reference to our repository
        $dvdRepository = new DvdRepository();

        // add to args array
        // ------------
        $argsArray['dvds'] = $dvdRepository->getAllDvds();

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /about
    public function aboutAction()
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($this->app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'about';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /about
    public function iceCreamAction(string $flavour)
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($this->app);
        $argsArray = array(
            'username' => $username,
            'flavour' => $flavour
        );

        // render (draw) template
        // ------------
        $templateName = 'iceCream';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    // action for route:    /about
    public function makeErrorAction()
    {
        // test this

        $this->app->abort(404, 'I am a code generated 404 error message');

    }
}