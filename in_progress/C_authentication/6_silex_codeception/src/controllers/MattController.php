<?php
namespace Itb\Controller;

use Itb\WebApplication;
use Symfony\Component\HttpFoundation\Request;

class MattController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }

    public function indexAction()
    {
        $argsArray = [];
        $templateName = 'matt';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    public function nameAction(string $name):string
    {
        $escapedName = $this->app->escape($name);
        $argsArray = [
            'name' => $name
        ];
        $templateName = 'matt_hello';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }


}
