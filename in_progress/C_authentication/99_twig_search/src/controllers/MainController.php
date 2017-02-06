<?php

namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Hdip\Model\DvdRepository;

class MainController
{
    // action for route:    /
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
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
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /index
    public function listAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
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
        $templateName = 'list';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    // action for route:    /show/
    public function showMissingIdAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        $argsArray['message'] = 'you must provide an id for the show page (e.g. /show/1)';

        // render (draw) template
        // ------------
        $templateName = 'error';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /show/{id}
    public function showAction(Request $request, Application $app, $id)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // get reference to our repository
        $dvdRepository = new DvdRepository();

        // try to get book for this ID
        $dvd = $dvdRepository->getOneDvd($id);

        // build args array
        // ------------
        if (null != $dvd){
            // book found§
            $argsArray['dvd'] = $dvd;
            $templateName = 'show';
        } else {
            // dvd NOT found
            $argsArray['message'] = 'no dvd found with id = ' . $id;
            $templateName = 'error';
        }


        // render (draw) template
        // ------------
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}