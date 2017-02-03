<?php

namespace Itb\Controller;

namespace Itb\Controller;

use Itb\Model\DvdRepository;
use Itb\WebApplication;

class AdminController extends Controller
{
    private $app;

    public function __construct(WebApplication $app)
    {
        parent::__construct($app);
        $this->app = $app;
    }

    // action for route:    /admin
    // will we allow access to the Admin home?
    public function indexAction()
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($this->app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $this->app->redirect('/login');
        }

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'admin/index';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /adminCodes
    // will we allow access to the Admin home?
    public function codesAction()
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($this->app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $this->app->redirect('/login');
        }

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'admin/codes';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }



}