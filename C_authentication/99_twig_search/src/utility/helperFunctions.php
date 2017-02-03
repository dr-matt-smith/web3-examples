<?php
use Silex\Application;

/**
 * add namespace to the string, after exploding controller name from action
 *
 * examples:
 * input:   Hdip, main/index
 * output:  Hdip\MainController::indexAction
 *
 * input:   Mattsmithdev\Samples, hello/name
 * output:  Mattsmithdev\Samples\HelloController::nameAction
 *
 * @param $shortName controller and action name sepaerate by "/"
 * @return string namespace, controller class name plus :: plus action name
 */
function controller($namespace, $shortName)
{
    list($shortClass, $shortMethod) = explode('/', $shortName, 2);

    $shortClassCapitlise = ucfirst($shortClass);

    $namespaceClassAction = sprintf($namespace . '\\' . $shortClassCapitlise . 'Controller::' . $shortMethod . 'Action');

    return $namespaceClassAction;
}

function getAuthenticatedUserName(Application $app)
{
    // if 'user' found with non-null value in 'session', then authenticate
    $user = $app['session']->get('user');
    if(null != $user) {
        return $user['username'];
    } else {
        return null;
    }
}

