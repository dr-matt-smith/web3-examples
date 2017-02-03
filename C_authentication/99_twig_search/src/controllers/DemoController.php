<?php

namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Hdip\Model\DvdRepository;

/**
 * Class DemoController
 *
 * demonstrate how to extract GET parameters from the Request
 * (e.g. after form submission, or JS link etc.
 *
 * The Request object parameter for every Controller method is a Symfony component
 * we can see that $request->query is a 'PamameterBag' i.e. an associative array just like $_GET
 * http://api.symfony.com/master/Symfony/Component/HttpFoundation/Request.html
 *
 * @package Hdip\Controller
 */
class DemoController
{
    // action for route:    /hello?name={name}
    public function helloAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // retrive 'name' from GET params in Request object
        $params = $request->query->all();
        $name = $params['name'];

        // build args array
        // ------------
        $argsArray['name'] = $name;

        // render (draw) template
        // ------------
        $templateName = 'hello';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /search?keyword={keyword}
    public function searchAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // retrive 'keyword' from GET params in Request object
        $params = $request->query->all();
        $keyword = $params['keyword'];

        // here is a list of recipes
        $recipes = [];
        $recipes[] = 'recipe: mint cheesecake';
        $recipes[] = 'recipe: chocolate cheesecake';
        $recipes[] = 'recipe: Boston cheesecake';
        $recipes[] = 'recipe: Somerset clotted cream cheesecake';
        $recipes[] = 'recipe: death by chocolate';
        $recipes[] = 'recipe: xmas mince pies';
        $recipes[] = 'recipe: xmas pudding';
        $recipes[] = 'recipe: xmas cake';


        // build args array
        // ------------
        $argsArray['recipes'] = $recipes;
        $argsArray['keyword'] = $keyword;

        // render (draw) template
        // ------------
        $templateName = 'search';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

}