# Rather than an 'app' property of our class, let's SUBCLASS the Silex Application itself

1. declare new class WebApplication in `/src`

    ```
    use Silex\Application;

    class WebApplication extends Application
    {
        public function __construct()
        {
            parent::__construct();

            $this['debug'] = true;

            $this->addRoutes();
        }

        public function addRoutes()
        {
            //----------- map 'routes' to controller 'actions' -----------
            // main routes
            $this->get('/',        'Itb\MainController::indexAction');
            $this->get('/contact', 'Itb\MainController::contactAction');

            // hello routes
            $this->get('/hello',        'Itb\HelloController::indexAction');
            $this->get('/hello/{name}', 'Itb\HelloController::nameAction');

        }

    ```

note use of `parent::__construct()` in our constructor
