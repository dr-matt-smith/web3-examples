<?php
namespace Itb;

use Silex\Application as SilexApp;
use Symfony\Component\HttpFoundation\Request;

class LoginController
{
    public function loginAction(Request $request, SilexApp $app)
    {
        $argsArray = [];
        $templateName = 'loginForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
