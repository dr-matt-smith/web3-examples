<?php

namespace Itb;

class AdminController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }

    // action for route:    /admin
    // will we allow access to the Admin home?
    public function indexAction()
    {
        // test if 'username' stored in session ...
        $username = $this->getAuthenticatedUserName();

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $this->app->redirect('/login');
        }

        // store username into args array
        $argsArray = [];

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
        $username = $this->getAuthenticatedUserName();

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $this->app->redirect('/login');
        }

        // store username into args array
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'admin/codes';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * if user logged-in, THEN return user's username
     * if user not logged-in THEN return 'null'
     *
     * @return null (or string username)
     */
    public function getAuthenticatedUserName()
    {
        // IF object (array) 'user' found with non-null value in 'session'
        $user = $this->app['session']->get('user');

        if (null != $user) {
            // THEN return username inside 'user' array
            return $user['username'];
        } else {
            // ELSE return 'null' (i.e. no user logged in at present)
            return null;
        }
    }
}