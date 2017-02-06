<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 31/01/2017
 * Time: 08:21
 */

namespace Itb\Controller;


use Symfony\Component\Security\Core\User\User;

class Controller
{
    protected $userController;

    public function __construct()
    {
        $this->userController = new UserController();
    }

}