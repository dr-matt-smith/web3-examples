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
class AdminController extends Controller
{
    // action for route:    /admin
    // will we allow access to the Admin home?
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'admin/index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /adminCodes
    // will we allow access to the Admin home?
    public function codesAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'admin/codes';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }



}