# Prod vs. Dev - chooseing system run/build mode

Let's choose PROD or DEV when we create the application object in `/public/index.php`.

Do the following:

1.


1. We'll add to our `WebApplication` class constants for PROD and DEV options:

    ```
    namespace Itb;

    use Silex\Application;
    use Silex\Provider;
    use Symfony\Component\Debug\ErrorHandler;

    class WebApplication extends Application
    {
        /**
         * constant for DEV version of system
         * development = testing = maximum error messages
         */
        const DEV = 0;

        /**
         * constant for PROD version of the system
         * production = live website = catch errors and have nice messages for real world users
         */
        const PROD = 1;
    ```

1. In the constructor we'll expect a parameter of one of these values, and setup debug / error capture as appropriate:

    ```
    public function __construct(int $environment)
    {
        parent::__construct();

        // setup Session and Service controller provider
        $this->register(new Provider\SessionServiceProvider());
        $this->register(new Provider\ServiceControllerServiceProvider());

        $this->setupTwig();
        $this->addRoutes();

        // environment setup
        if(self::DEV == $environment){
            $this['debug'] = true;
        } else {
            // neatly handle errors and exceptions with controllers
            $this->handleErrorsAndExceptions();
        }
    }
    ```

   So if DEV we set debug to true, otherwise (PROD) we activate our error handler withe nice error Twig template

1. In `/public/index.php` we just need to comment out the appropriate statement to choose whether our applicaiton is create in DEV or PROD mode:

    ```
    <?php

    //----------- includes -----------------
    require_once __DIR__.'/../vendor/autoload.php';

    //----------- create 'app' object ---------
    use Itb\WebApplication;

    //---- choose DEV or PROD -------
    $environment = WebApplication::DEV;
    //$environment = WebApplication::PROD;

    //----- create applicaiton with DEV/PROD option
    $app = new WebApplication($environment);

    //---- run the router/dispatcher -------
    $app->run();
    ```