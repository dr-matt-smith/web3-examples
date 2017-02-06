# add login authentication (part 2 of 2)

In this second step, we start using Silex's SESSION service, to allow us to store successful login authenication details between requests.


Here's a taster of the code to extract the username and password from the POST data received from the HTTP Request:

    // retrieve 'name' from GET params in Request object
    $request = $this->app['request_stack']->getCurrentRequest();

    $username = $request->get('username');
    $password = $request->get('password');


1. We need to enable sessions in our WebApplication. We add a statement in the constructor to do this, next to our existing statement for the Service provider):

    ```
        public function __construct()
        {
            parent::__construct();

            // setup Session provider
            $this->register(new Provider\SessionServiceProvider());

            $this->register(new Provider\ServiceControllerServiceProvider());

            $this['debug'] = true;
            $this->setupTwig();
            $this->addRoutes();
        }
    ```

1. We will add to the `processLoginAction()` in our `UserController` class.

    If username and password both equal 'user', then we store the username in the Application session object (`$this->app['session']->set('user' ...`) and redirect to the `/admin` route.

    ```
    // action for POST route:    /processLogin
    public function processLoginAction()
    {
        // retrieve 'name' from GET params in Request object
        $request = $this->app['request_stack']->getCurrentRequest();
        $username = $request->get('username');
        $password = $request->get('password');

        // authenticate!
        if ('user' === $username && 'user' === $password) {
            // store username in 'user' in 'session'
            $this->app['session']->set('user', array('username' => $username) );

            // success - redirect to the secure admin home page
            return $this->app->redirect('/admin');
        }

        // login page with error message
        // ------------
        $templateName = 'login';
        $argsArray = array(
            'errorMessage' => 'bad username or password - please re-enter',
        );

        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    ```

    Note that `$this->app['session']` is a PHP `associative array` (a.k.a. a `map`). We must keep this in mind when storing and retrieve data from this session object. In this case we are storing key-value `'username' => &username`
