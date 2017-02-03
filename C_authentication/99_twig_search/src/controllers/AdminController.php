<?php

namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Hdip\Model\DvdRepository;

/**
 * Class AdminController
 *
 * simple authentication using Silex session object
 * $app['session']->set('isAuthenticated', false);
 *
 * but the propert way to do it:
 * https://gist.github.com/brtriver/1740012
 *
 * @package Hdip\Controller
 */
class AdminController
{
    // action for route:    /index
    // will we allow access to the Admin home?
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            return $app->redirect('/login');
        }

        // render (draw) template
        // ------------
        $templateName = 'admin';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


}