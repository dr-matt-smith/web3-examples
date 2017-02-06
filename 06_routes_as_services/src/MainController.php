<?php
namespace Itb;

class MainController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }

    // action for route:    /
    public function indexAction()
    {
        // add to args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /
    public function contactAction()
    {
        // add to args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'contact';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

}