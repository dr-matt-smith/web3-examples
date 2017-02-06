<?php
namespace Itb;

use Itb\Model\DvdRepository;

class MainController
{
    private $app;

    public function __construct(WebApplication $app)
    {
        $this->app = $app;
    }

    // action for route:    /
    public function indexAction()
    {
        // add to args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    // action for route:    /contact
    public function contactAction()
    {
        // add to args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'contact';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }


    // action for route:    /list
    public function listAction()
    {

        // get reference to our repository
        // and get array of all DVDs
        $dvdRepository = new DvdRepository();
        $dvds = $dvdRepository->getAllDvds();

        // add to args array
        // ------------
        $argsArray = [
            'dvds' => $dvds
        ];

        // render (draw) template
        // ------------
        $templateName = 'list';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

}