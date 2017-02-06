<?php

namespace Itb;

class UserController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }


    // action for route:    /login
    public function loginAction()
    {
        // build args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'login';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    // action for POST route:    /processLogin
    public function processLoginAction()
    {
        // retrieve 'name' from GET params in Request object
        $request = $this->app['request_stack']->getCurrentRequest();
        $username = $request->get('username');
        $password = $request->get('password');

        // authenticate!
        if ('user' === $username && 'user' === $password) {
            // success - redirect to the secure admin home page
            return $this->app->redirect('/admin');
        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter',
            'username' => null // we don't care what old username was since this is login screen
        );

        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }





}