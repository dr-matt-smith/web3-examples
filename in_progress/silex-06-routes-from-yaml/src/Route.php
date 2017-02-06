<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 21/01/2017
 * Time: 18:29
 */

namespace Itb;


class Route
{
    private $routeName;
    private $routePattern;
    private $namespaceString;
    private $method;
    private $action;
    private $controller;

    /**
     * Route constructor.
     *
     * @param $routeName
     * @param $routePattern
     * @param $namespaceString
     * @param $action
     * @param $controller
     */
    public function __construct($routeName, $routeData)
    {
        $route = $routeData['route'];
        $namespaceString = '\\' . __NAMESPACE__ . '\\';
        $method = $routeData['method'];
        $action = $routeData['action'];
        $controller = $routeData['controller'];

        $this->routeName = $routeName;
        $this->routePattern = $route;
        $this->namespaceString = $namespaceString;
        $this->method = $method;
        $this->action = $action;
        $this->controller = $controller;
    }


    /**
     * @return mixed
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @param mixed $routeName
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;
    }

    /**
     * @return mixed
     */
    public function getRoutePattern()
    {
        return $this->routePattern;
    }

    /**
     * @param mixed $routePattern
     */
    public function setRoutePattern($routePattern)
    {
        $this->routePattern = $routePattern;
    }

    /**
     * @return mixed
     */
    public function getNamespaceString()
    {
        return $this->namespaceString;
    }

    /**
     * @param mixed $namespaceString
     */
    public function setNamespaceString($namespaceString)
    {
        $this->namespaceString = $namespaceString;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }





}