<?php

namespace Itb;

use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: matt
 * Date: 07/10/2015
 * Time: 14:58
 */
class HelloController
{
    public function indexAction(Request $request, \Silex\Application $app):string
    {
        return 'Hello - whatever your name is';
    }

    public function nameAction(Request $request, \Silex\Application $app, string $name):string
    {
        $escapedName = $app->escape($name);
        return 'Hello ' .  $escapedName;
    }
}