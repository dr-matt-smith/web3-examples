<?php

namespace Itb;

class AdminController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }

    // action for route:    /admin
    // will we allow access to the Admin home?
    public function indexAction()
    {
        // store username into args array
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'admin/index';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /adminCodes
    // will we allow access to the Admin home?
    public function codesAction()
    {
        // store username into args array
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'admin/codes';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}