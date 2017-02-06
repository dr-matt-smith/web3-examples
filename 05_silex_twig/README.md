# add Twig

1. make composer install Twig library in `/vendor`

    ```
    composer require twig/twig
    ```

1. add private string variable in WebApplication stating where templates are located

    ```
    private $myTemplatesPath = __DIR__ . '/../templates';
    ```

1. add, and call from constructor, method to setup twig service

    ```
    public function setupTwig()
    {
        // register Twig with Silex
        // ------------
        $this->register(new \Silex\Provider\TwigServiceProvider(),
            [
                'twig.path' => $this->myTemplatesPath
            ]
        );
    }
    ```

1. update Controller Methods to call render method of Twig object in app

    ```
    public function indexAction(Request $request, Application $app):string
    {
        $argsArray = [];
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
    ```

1. create `/templates` directory and twig templates for index and contact etc.