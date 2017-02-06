<?php

namespace Itb;


use Silex\Application;

class ErrorController
{
    // action for ERRORS
    public function errorAction(Application $app, string $errorMessage)
    {
        // render (draw) template
        // ------------
        $templateName = 'error/general';

        $argsArray = array(
            'message' => $errorMessage
        );

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
