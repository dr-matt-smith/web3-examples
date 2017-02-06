<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

$routePath = __DIR__ . '/../app/routes.yml';
$routes = null;

try {
    $routes = Yaml::parse(file_get_contents($routePath));
} catch (ParseException $e) {
    printf("Unable to parse the YAML string: %s", $e->getMessage());
}

if(null != $routes){
    var_dump($routes);
    create_routes($routes);
} else {
    print 'error reading routes file';
}

function create_routes($routes)
{
    $endOfLine = PHP_EOL . '<br>' . PHP_EOL;

    foreach($routes as $routeName => $data){
        $route = $data['route'];
        $controller = $data['controller'];
        $action = $data['action'];
        $method = $data['method'];
        print 'route name = ' . $routeName;
        print $endOfLine;
        print '$app->' . $method . '(\'' . $route . '\', \'\\\\Itb\\\\' . $controller . '::' . $action . '\');';
        print $endOfLine;
        print $endOfLine;

    }
}
