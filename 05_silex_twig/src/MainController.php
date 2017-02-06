<?php
namespace Itb;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function indexAction(Request $request, Application $app):string
    {
        $argsArray = [];
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function contactAction(Request $request, Application $app):string
    {
        $argsArray = [];
        $templateName = 'contact';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
