<?php

namespace App\src\Controller;

use App\src\Controller\TwigController;
use App\src\Entity\User;

class HomeController extends TwigController
{

    public function index()
    {
        echo $this->twig->render('home/index.html.twig', [
            'data' => '',
            'session' => $_SESSION,
        ]);
    }

    public function list()
    {
        $user = new User();
        $users = $user->getUserList();
        echo $this->twig->render('home/index.html.twig', [
            'data' => 'Bienvenue sur le controller Home/List!',
            'users' => $users,
            'session' => $_SESSION
        ]);
    }
}
