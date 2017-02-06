# add login authentication (part 1 of 3)

This first step for login authentication involves:
- a login page
- a method to extract and process gthe POST data username and password submitted form the login form
- routes for and admin home page, and an admin secret codes page

HOWEVER - in this first step there won't actually be any checks on the admin pages to see if the user is actually logged in (that's in part 2 ...)

We'll do login and logout actions from a `UserController` class
We'll manage secure 'admin' actions from an `AdminController` class

Processing form data (e.g. from POST login submission) will illustrate how we access variables from the Request object inside our `WebApplication` object.

We'll have 2 routes that should only be access when the user is logged in (`/admin` and `/admin/codes`). So we need to process login data and store successful login status in the SESSION object inside our application object (it's all about storing objects in our applications DI (Dependency Injection) container).


Here's a taster of the code to extract the username and password from the POST data received from the HTTP Request:

    // retrieve 'name' from GET params in Request object
    $request = $this->app['request_stack']->getCurrentRequest();

    $username = $request->get('username');
    $password = $request->get('password');


1. In `WebApplication->addRoutes()` we add our 2 new classes (`UserController` and `AdminController`) as services:

    ```
    $this['user.controller'] = function() { return new UserController($this);   };
    $this['admin.controller'] = function() { return new AdminController($this);   };
    ```

1. let's add login form (`/login` GET request) to display the login form to the user. This will be a simple action to just render (display) a login form Twig template.

    ```
    // ------ login routes GET and POST ------------
    $this->get('/login', 'user.controller:loginAction');
    ```

1. let's add process login form data action (`/login` POST request) route to `WebApplication->addRoutes()`. So when we receive a 'login' route with the POST method we'll process that with `UserController->processLoginAction()`

    ```
    // ------ login routes GET and POST ------------
    $this->post('/login', 'user.controller:processLoginAction');
    ```

1. let's also add 2 routes for our administrator, admin (home page) and admin secret codes page:

    ```
    // ------ SECURE PAGES ----------
    $this->get('/admin',  'admin.controller:indexAction');
    $this->get('/admin/codes',  'admin.controller:codesAction');
    ```

1. let's create a base template for all our Twig pages - for now a list of all route links (even though some won't work if we're not logged in) `/templates/_base.html.twig`:

    ```
    ...
        <nav>
            <ul>
                <li>
                    <a href="/">home</a>
                </li>

                <li>
                    <a href="/contact">contact</a>
                </li>

                <li>
                    <a href="/login">login</a>
                </li>
                <li>
                    <hr>
                    <a href="/admin">secure Admin home</a>
                </li>

                <li>
                    <a href="/admin/codes">secret codes list</a>
                </li>
            </ul>
        </nav>
    ...


    ```


1. Let's create the login form Twig template `/templates/login.html.twig`. This makes the main part of the page present a form, using the POST method to route `/login`.


    We add an `autofocus` on the Username input, so if we have an error and revisit this page the users cursor is automatically ready to type the username ...

    ```

    {% extends '_base.html.twig' %}

    {% block main %}

        <h1>Please login</h1>
        <form
                method="post"
                action="/login"
                >

            <p>
                Username:
                <input type="text" name="username" autofocus>
            </p>

            <p>
                Password:
                <input type="password" name="password">
            </p>
            <input type="submit" value="login">
        </form>

    {% endblock %}

    ```

1. We declare our `UserController` class (just like `MainController` with a constructor storing a reference to an application object):

    ```
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
    ```

1. Now we add a method `processLoginAction()` to our `UserController` class. This extracts username and password from the POST Request data.

    Note, for now we'll hard code authentication to username 'user' and password 'user':

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

    As you can see, if username and password both equal 'user', redirect to the `/admin` route. Otherwise we set an `errorMessage` variable and display the `login` template again.

1. So we need to add code to our `login.html.twig` template to display the `errorMessage` text, if it is received:

    ```

    {% if errorMessage is defined %}
        <p class="error">
            {{ errorMessage }}
        </p>

        <hr>
    {% endif %}

    <h1>Please login</h1>
    <form
            method="post"
            action="/login"
            >

    ... rest of login form

    ```

    As you can see, we use the Twig statement `if errorMessage is defined` to test whether any variable `errorMessage` has been passed to the Twig renderer.

1. We can add a simple CSS style sheet to make a nicely padded, pink style for error paragraphs `/public/css/styles.css`:

    ```
    p.error {
        padding: 1rem;
        background-color: pink;
    }
    ```

1. We can define Twig templates for our admin home page `/templates/admin/index.html.twig` (it's handy to put all out secure admin pages in its own subdirectory of `/templates`:

    ```
    {% extends '_base.html.twig' %}

    {% block title %}admin home{% endblock %}

    {% block main %}

        <h1>Welcome to the Admin home page !</h1>

    {% endblock %}
    ```

1. And another Twig template for the Admin secret codes page `/templates/admin/codes.html.twig`:

    ```
    {% extends '_base.html.twig' %}

    {% block title %}admin codes{% endblock %}

    {% block main %}

        <h1>Here are today's secret agent codes</h1>

        <ul>
            <li>
                q: how is the weather in Limerick?
                <br>
                a: wet and windy for this time of year
            </li>

        ... etc.
    ```

