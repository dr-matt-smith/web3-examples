<?php
namespace Itb;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function indexAction(Request $request, Application $app):string
    {
        return 'Hello world';
    }

    public function contactAction(Request $request, Application $app):string
    {
        return 'Contact Us as: 012 885 1098 or email to: info@itb.ie';
    }
}
