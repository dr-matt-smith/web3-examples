# link routes to methods of controller classes

1. define routes with namespaced class and method in `index.php`

    ```
    $app->get('/',        'Itb\MainController::indexAction');
    $app->get('/contact', 'Itb\MainController::contactAction');
    ```


2. write controller class methods (which are given parameters of Symfony request and Silex App)

    ```
    public function indexAction(Request $request, Application $app)
    {
        return 'Hello world';
    }
    ```

