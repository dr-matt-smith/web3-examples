<?php

namespace Itb;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class HelloController
{
    public function indexAction(Request $request, Application $app)
    {
        return 'Hello - whatever your name is';
    }

    public function nameAction(Request $request, Application $app, $name)
    {
        $escapedName = $app->escape($name);
        return 'Hello ' .  $escapedName;
    }
}