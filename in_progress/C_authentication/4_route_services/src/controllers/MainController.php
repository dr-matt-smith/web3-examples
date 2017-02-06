<?php

namespace Itb\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Itb\Model\DvdRepository;

class MainController extends Controller
{
    // action for route:    /
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($app);
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

    // action for route:    /about
    public function aboutAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'about';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /about
    public function iceCreamAction(Request $request, Application $app, string $flavour)
    {
        // test if 'username' stored in session ...
        $username = $this->userController->getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username,
            'flavour' => $flavour
        );

        // render (draw) template
        // ------------
        $templateName = 'iceCream';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    // action for route:    /about
    public function makeErrorAction(Request $request, Application $app)
    {
        // test this

        $app->abort(404, 'I am a code generated 404 error message');

    }
}