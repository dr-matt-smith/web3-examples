# web3-examples

This repository illustrates progressive development of a simple web application using the Silex micro-framework

[http://silex.sensiolabs.org/](http://silex.sensiolabs.org/)

Notes

1. You'll need to run `composer update` to get the `/vendor` directory repopulated (since vendor files are not archived - via the `.gitignore` files)

1. Since none of these examples (at the time of writing) actually use a database, you can get away with using the PHP built-in web server. There is a Composer script `run` to run the server pointing requests at the `/public` directory. So just:

    - `cd` into the numbered project version directory
    - run the PHP web server with `$ composer run`
    - open a browser and point it to: `http:localhost:8888` to test the project files

Each version of the project has its own `README.md` file
- if you don't have a Markdown reader on your computer (there are free plug-ins for most IDEs...), then these READMEs are probably easier to read on the GitHub repro page, since GitHub loves markdown ...


Todo:

- web profiler debug bar
- monolog logging
- unit testing
- DB testing
- travis CI
- reading YAML routes