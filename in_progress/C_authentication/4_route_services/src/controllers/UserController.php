<?php

namespace Itb\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Itb\Model\DvdRepository;

/**
 * Class UserController
 *
 * simple authentication using Silex session object
 * $app['session']->set('isAuthenticated', false);
 *
 * but the propert way to do it:
 * https://gist.github.com/brtriver/1740012
 *
 * @package Itb\Controller
 */
class UserController
{
    // action for POST route:    /processLogin
    public function processLoginAction(Request $request, Application $app)
    {
        // retrieve 'name' from GET params in Request object
        $username = $request->get('username');
        $password = $request->get('password');

        // authenticate!
        if ('user' === $username && 'user' === $password) {
            // store username in 'user' in 'session'
            $app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $app->redirect('/admin');
        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter',
            'username' => null // we don't care what old username was since this is login screen
        );

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /login
    public function loginAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        // build args array
        // ------------
        $argsArray = array(
            'username' => null // we don't care what old username was since this is login screen
        );
        // render (draw) template
        // ------------
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /logout
    public function logoutAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        // redirect to home page
//        return $app->redirect('/');

        // build args array
        // ------------
        $argsArray = array(
            'username' => null // we don't care what old username was since this is login screen
        );

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);

    }


    /**
     * if user logged-in, THEN return user's username
     * if user not logged-in THEN return 'null'
     *
     * @param Application $app
     * @return null (or string username)
     */
    public function getAuthenticatedUserName(Application $app)
    {
        // IF 'user' found with non-null value in 'session'
        $user = $app['session']->get('user');

        if (null != $user) {
            // THEN return username inside 'user' array
            return $user['username'];
        } else {
            // ELSE return 'null' (i.e. no user logged in at present)
            return null;
        }
    }




}