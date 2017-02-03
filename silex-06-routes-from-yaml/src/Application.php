<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 15:52
 */

namespace Itb;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Config\Definition\Exception\Exception;

use Symfony\Component\Debug\ErrorHandler;

class Application
{
    /**
     * @var \Silex\Application
     */
    private $app;


    public function __construct()
    {
        //----------- create 'app' object ---------
        $this->app = new \Silex\Application();

        $this->addErrorHandler();

        $this->setupTwig();
        $this->setupMonolog();

        $this->readAndAddRoutesFromFile();

    }

    public function addErrorHandler()
    {
        //ErrorHandler::register();
        //ExceptionHandler::register();

        // add general catch error route
        $this->app->error(function (){
            $argsArray = [
                'message' => 'We are sorry, but something went terribly wrong.'
            ];
            $template = 'error';
            return $this->app['twig']->render($template . '.html.twig', $argsArray);
        });

        /*
        $this->app->error(function (\Exception $e, Request $request, $code) {
            return new Response('We are sorry, but something went terribly wrong.');
        });
        */

    }

    public function run()
    {
        $this->app->run();
    }

    public function readAndAddRoutesFromFile()
    {
        $routePath = __DIR__ . '/../app/routes.yml';
        $yamlRouteReader = new YamlRouteReader();
        $routes = $yamlRouteReader->readRoutesFromFile($routePath);
        $this->addRoutesFromArray($routes);
    }


    public function setupTwig()
    {
        // location of Twig templates
        $myTemplatesPath = __DIR__ . '/../templates';

        // register Twig with Silex
        // ------------
        $this->app->register(new \Silex\Provider\TwigServiceProvider(),
            [
                'twig.path' => $myTemplatesPath
            ]
        );

    }

    public function setupMonolog()
    {
        // location of Twig templates
        $myLoggingPath = __DIR__ . '/../logs/development.log';

        $this->app->register(new \Silex\Provider\MonologServiceProvider(),
            [
                'monolog.logfile' => $myLoggingPath
            ]
        );
    }

    public function addRoutesFromArray(array $routes)
    {
        foreach ($routes as $route){
            $this->addRoute($route);
        }
    }

    public function addRoute(Route $route)
    {
        $method = $route->getMethod();
        $routePattern = $route->getRoutePattern();
        $namespace = $route->getNamespaceString();
        $controller = $route->getController();
        $action = $route->getAction();

        $controllerMethodString = $namespace . $controller . '::' . $action;

        switch($method){
            case 'post':
                $this->app->post($routePattern, $controllerMethodString);
                break;

            case 'get':
            default:
                $this->app->get($routePattern, $controllerMethodString);
        }

        $this->app['monolog']->debug('adding ' . $method . ' route ' . $routePattern);
        $message = "\$this->app->get('$routePattern', '$controllerMethodString');";
        $this->app['monolog']->debug($message);
    }


}