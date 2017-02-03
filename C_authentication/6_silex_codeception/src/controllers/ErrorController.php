<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 31/01/2017
 * Time: 10:33
 */

namespace Itb\Controller;


use Silex\Application;

class ErrorController
{
    // action for ERRORS
    public function errorAction(Application $app, string $errorMessage)
    {
        // render (draw) template
        // ------------
        $templateName = 'error';

        $argsArray = array(
            'username' => null,
            'message' => $errorMessage
        );

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

}
