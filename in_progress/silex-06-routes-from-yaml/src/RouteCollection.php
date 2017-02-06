<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 18:33
 */

namespace Itb;


class RouteCollection
{
    private $routeObjects;

    public function __construct($routes)
    {
        $this->routeObjects = [];
        foreach ($routes as $routeName => $routeArray) {
            $routeObject = new Route($routeName, $routeArray);
            $this->routeObjects[] = $routeObject;
        }
    }

    /**
     * @return array
     */
    public function getRouteObjects(): array
    {
        return $this->routeObjects;
    }



}