<?php
namespace Itb;

use Silex\Application as SilexApp;
use Symfony\Component\HttpFoundation\Request;

class MainController
{
    public function indexAction(Request $request, SilexApp $app)
    {
        return 'Hello world';
    }

    public function contactAction(Request $request, SilexApp $app)
    {
        return 'Contact Us as: 012 885 1098 or email to: info@itb.ie';
    }
}
