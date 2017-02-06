# tidy up Controllers - make them services

A controller declared as a service will be 'lazily loaded' - an instance will only be created when it is actually requested.

Controllers as services are resource objects offered by the dependency injection container - so they can be replaced by 'mock/fake' classes for testing.

Classes written as services are more independent of the system they are in, so they will require less / little / sometimes no changes to be used with other frameworks - we are decreasing the dependencies between the components of our system.

Finally, parameters can be provided upon construction, removing the need for parameters like the HTTP request or Silex Applicaiton objects for each controller method. Parameters provided upon construction can be stored as properties that can be access by methods when required.

It all sounds a lot more complicated that it is in practice.

http://silex.sensiolabs.org/doc/2.0/providers/service_controller.html



1. refactor our Controller classes - private property `$app` (`Itb\WebApplication`) provided upon construction:

    ```
    <?php
    namespace Itb;

    use Itb\WebApplication;

    class MainController
    {
        private $app;

        public function __construct(WebApplication $app)
        {
            $this->app = $app;
        }

    ```

1. remove parameters from the controller class methods

    ```
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
    ```

1. in the `WebApplication` constructor we need to enable the Silex Controller 'service':

    ```
    class WebApplication extends Application
    {
        // location of Twig templates
        private $myTemplatesPath = __DIR__ . '/../templates';

        public function __construct()
        {
            parent::__construct();

            // setup Service controller provider
            $this->register(new Provider\ServiceControllerServiceProvider());
    ```

1. in `WebApplication` method `addRoutes()` we need to first add an instance of each controller class as a service inside our application:

    ```
    public function addRoutes()
    {
        $this['main.controller'] = function() { return new MainController($this);   };
    ```


1. then we associate routes with controller class methods:

    ```
    public function addRoutes()
    {
        $this['main.controller'] = function() { return new MainController($this);   };

        //==============================
        // now define the routes
        //==============================
        $this->get('/', 'main.controller:indexAction');
        $this->get('/contact','main.controller:contactAction');

    ```

