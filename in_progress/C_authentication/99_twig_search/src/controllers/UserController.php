<?php

namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Hdip\Model\DvdRepository;

/**
 * Class UserController
 *
 * simple authentication using Silex session object
 * $app['session']->set('isAuthenticated', false);
 *
 * but the propert way to do it:
 * https://gist.github.com/brtriver/1740012
 *
 * @package Hdip\Controller
 */
class UserController
{
    // action for POST route:    /processLogin
    public function processLoginAction(Request $request, Application $app)
    {
        // retreive 'name' from GET params in Request object
        $username = $request->get('username');
        $password = $request->get('password');

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter'
        );

        // authenticate!
        if ('user' === $username && 'user' === $password) {
            // store username in 'user' in 'session'
            $app['session']->set('user', array('username' => $username) );

            /*


            // login page with error message
            // ------------
            $templateName = 'admin';
            $argsArray = array(
                'username' => $username
            );
            */

            return $app->redirect('/admin');
        }

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /login
    public function loginAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        // build args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /login
    public function logoutAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        // redirect to home page
//        return $app->redirect('/');

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', []);

    }


}