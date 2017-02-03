<?php
namespace Itb\Controller;

use Itb\WebApplication;

class Controller
{
    protected $userController;

    public function __construct(WebApplication $app)
    {
        $this->userController = new UserController($app);
    }
}