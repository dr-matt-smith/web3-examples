<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 18:30
 */

namespace Itb;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class YamlRouteReader
{
    public function readRoutesFromFile(string $routePath):array
    {

        try {
            $routeArrays = Yaml::parse(file_get_contents($routePath));
            $routeCollection = new RouteCollection($routeArrays);

            return $routeCollection->getRouteObjects();
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
            return null;
        }
    }
}



