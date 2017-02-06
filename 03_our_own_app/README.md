# Create our own WebApplication class, so setup in constuctor

1. declare new class WebApplication in `/src`

    ```
    class WebApplication
    {
        /**
         * @var \Silex\Application
         */
        private $app;

        public function __construct()
        {
            //----------- create 'app' object ---------
            $this->app = new Application();

            $this->addRoutes();
        }

        public function run()
        {
            $this->app->run();
        }

        public function addRoutes()
        {
            //----------- map 'routes' to controller 'actions' -----------
            // main routes
            $this->app->get('/',        'Itb\MainController::indexAction');
            $this->app->get('/contact', 'Itb\MainController::contactAction');

            // hello routes
            $this->app->get('/hello',        'Itb\HelloController::indexAction');
            $this->app->get('/hello/{name}', 'Itb\HelloController::nameAction');
        }
    ```


2. our front controller `public/index.php` is now very clean and simple

    ```
    //----------- create 'app' object ---------
    $app = new Itb\WebApplication();

    $app->run();
    ```

