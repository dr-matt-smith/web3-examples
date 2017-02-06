# add a model class

We'll add a Dvd entity class, and a Repository class for DVD objects

To keep things tidy, model related classes will
- go into folder `/src/model`
- be in subnamespace: `Itb\\Model\\`


1. add a statement in `composer.json` stating that classes in namespace `Itb\\Model\\` are located in `/src/model`

    ```
    "Itb\\Model\\": "src/model"
    ```

1. make Composer re-created its autoloader

    ```
    $ composer dump-autoload
    ```

1. create directory `/src/model`

1. create class `Itb\Model\Dvd`

    ```
    namespace Itb\Model;

    class Dvd
    {
        private $id;
        private $title;

    etc.
    ```

1. creatre class `Itb\Model\DvdRepository`

    ```
    namespace Itb\Model;

    class DvdRepository
    {
        private $dvds;

        function __construct()
        {
            $dvd1 = new Dvd(1);
            $dvd1->setTitle('Jaws');
            $dvd1->setImage('jaws.jpg');
            $dvd1->setPrice(10.0);
            $dvd1->setDiscount(0.5);
            $this->addDvd($dvd1);

            etc.
        }

        private function addDvd(Dvd $dvd)
        {
            $id = $dvd->getId();
            $this->dvds[$id] = $dvd;
        }

        public function getAllDvds()
        {
            return $this->dvds;
        }

    ```

1. add a method to MainController to get all DVds and pass them to new template l`ist.html.twig`

    ```
    // action for route:    /list
    public function listAction()
    {

        // get reference to our repository
        // and get array of all DVDs
        $dvdRepository = new DvdRepository();
        $dvds = $dvdRepository->getAllDvds();

        // add to args array
        // ------------
        $argsArray = [
            'dvds' => $dvds
        ];

        // render (draw) template
        // ------------
        $templateName = 'list';
        return $this->app['twig']->render($templateName . '.html.twig', $argsArray);
    }
    ```

1. create new Twig template `list.html.twig`

    ```
    {% for dvd in dvds %}
        <p>
            id: {{ dvd.id }}
            <br>
            title: {{ dvd.title }}
            <br>
            price: {{ dvd.price }}
        </p>
    {% endfor %}
    ```

