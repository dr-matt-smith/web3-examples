# link routes to methods of controller classes

1. define routes with namespaced class and method in `index.php`

    ```
    $app->get('/',        'Itb\MainController::indexAction');
    $app->get('/contact', 'Itb\MainController::contactAction');
    ```

1. create a new class `MainController`, to contain methods to act for each route


    ```
    <?php
    namespace Itb;

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;

    class MainController
    {
    ```

1. write MainController controller class methods (which are given parameters of Symfony request and Silex App)

    ```
    public function indexAction(Request $request, Application $app)
    {
        return 'Hello world';
    }

    public function contactAction(Request $request, Application $app)
    {
        return 'Contact Us as: 012 885 1098 or email to: info@itb.ie';
    }

    ```



