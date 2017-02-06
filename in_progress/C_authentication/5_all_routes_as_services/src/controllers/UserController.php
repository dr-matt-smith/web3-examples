<?php

namespace Itb\Controller;

use Itb\WebApplication;

class UserController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }
    // action for POST route:    /processLogin
    public function processLoginAction()
    {
        // retrieve 'name' from GET params in Request object
        $request = $this->app['request_stack']->getCurrentRequest();
        $username = $request->get('username');
        $password = $request->get('password');

        // authenticate!
        if ('user' === $username && 'user' === $password) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/admin');
        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter',
            'username' => null // we don't care what old username was since this is login screen
        );

        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /login
    public function loginAction()
    {
        // logout any existing user
        $this->app['session']->set('user', null );

        // build args array
        // ------------
        $argsArray = array(
            'username' => null // we don't care what old username was since this is login screen
        );
        // render (draw) template
        // ------------
        $templateName = 'login';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /logout
    public function logoutAction()
    {
        // logout any existing user
        $this->app['session']->set('user', null );

        // redirect to home page
        return $this->app->redirect('/');

        /*

        // build args array
        // ------------
        $argsArray = array(
            'username' => null // we just logged out - no user name!
        );

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
*/
    }


    /**
     * if user logged-in, THEN return user's username
     * if user not logged-in THEN return 'null'
     *
     * @return null (or string username)
     */
    public function getAuthenticatedUserName()
    {
        // IF 'user' found with non-null value in 'session'
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