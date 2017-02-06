<?php
namespace Itb;

use Silex\Application as SilexApp;
use Symfony\Component\HttpFoundation\Request;

class MattController
{
    /**
     * @var SilexApp
     */
    private $app;

    /**
     * @var Request
     */
    private $request;

    public function __construct(SilexApp $app)
    {
        $this->app = $app;
        $this->request = $app['request'];
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
