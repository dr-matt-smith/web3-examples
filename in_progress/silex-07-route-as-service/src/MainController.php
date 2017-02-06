<?php
namespace Itb;

use Silex\Application as SilexApp;
use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function indexAction(Request $request, SilexApp $app)
    {
        $argsArray = [];
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function contactAction(Request $request, SilexApp $app)
    {
        $argsArray = [];
        $templateName = 'contact';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}
