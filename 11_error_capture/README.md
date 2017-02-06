# error capture for production (public websites) systems

When developing we want maximum information about errors.

But for production systems (public facing 'live' websites) we want to capture errors but handle what the user sees carefully.

Silex let's us declare general 'catch all' error handlers, that can catch unexpected errors, and also be used for our controllers to communicate errors to users

e.g.
- no such product with that ID
- your user level is not authorised for that action

    etc.

Follow these steps to set up production-ready error handling:

1. We'll add to our `WebApplication` class a method that will for forward all errors and exceptions to a dedicated `ErrorController` class that we'll create in a minute:

    ```
    public function handleErrorsAndExceptions ()
    {
        ErrorHandler::register();

        //register an error handler
        $this->error(function (\Exception $e, $code ) {

            //return your json response here
            $errorController = new ErrorController();
            $errorMessage = $e->getMessage();
            return $errorController->errorAction($this, $errorMessage);
        });
    }
    ```

    Note, we put this in a method, so later we can decide whether to use this or not, depending on whether we are running out system in development or production mode ...


1. Note we have to add a `use` statement so that the `Symfony\Component\Debug\ErrorHandler` ErrorHandler class is found in methd ` handleErrorsAndExceptions()`:

    ```
    <?php
    namespace Itb;

    use Silex\Application;
    use Silex\Provider;
    use Symfony\Component\Debug\ErrorHandler;

    class WebApplication extends Application
    {
    ```


1. In our constructor we'll call the method above to setup error handling:

    ```
    public function __construct()
    {
        parent::__construct();

        // setup Session and Service controller provider
        $this->register(new Provider\SessionServiceProvider());
        $this->register(new Provider\ServiceControllerServiceProvider());

        $this->setupTwig();
        $this->addRoutes();

        // debug for 'dev' mode
        // $this['debug'] = true;

        // setup error handling for 'prod' mode
        $this->handleErrorsAndExceptions();
    }
    ```

1. The ErrorController class itself is reasonable straightforward, declaring a single method `errorAction(...)`:

    ```
    <?php

    namespace Itb;


    use Silex\Application;

    class ErrorController
    {
        // action for ERRORS
        public function errorAction(Application $app, string $errorMessage)
        {
            // render (draw) template
            // ------------
            $templateName = 'error/general';

            $argsArray = array(
                'message' => $errorMessage
            );

            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    ```

1. We can now created the error Twig template page, in `/templates/error/general.html.twig`, which expects a variable `message` to display:

    ```
    {% extends '_base.html.twig' %}

    {% block title %}error page{% endblock %}

    {% block main %}
    <h1>whoops !</h1>

    <p class="error">
        {{ message }}
    </p>
    {% endblock %}
    ```

1. We can illustrate use of the error controller for the case where a user who is not logged-in attempts to access the `/admin` route.

   The code in the `AdminController->indexAction()` detects the user is not logged-in, and so generates an `abort` error with an appropriate error message:

   ```
   public function indexAction()
   {
       // test if 'username' stored in session ...
       $username = $this->getAuthenticatedUserName();

       // check we are authenticated --------
       $isAuthenticated = (null != $username);

       if(!$isAuthenticated){
           // not authenticated, so generate error
           $this->app->abort(404, 'unauthorised access error - you must login first');
       }

       etc.
   ```

Note - the error code number can be used (in WebApplication->handleErrorsAndExceptions()` to determine which ErrorController method is invoked - so different templates could be rendered for different kinds of errors (404 not founds errors, 500 server errors etc.)

