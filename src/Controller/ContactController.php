<?php

namespace App\src\Controller;

use App\src\Controller\TwigController;

class ContactController extends TwigController
{

    public function index()
    {
        echo $this->twig->render('contact/index.html.twig', [
            'data' => 'Bienvenue sur le controller Contact!',
            'session' => $_SESSION
        ]);
    }

    public function test($params)
    {
        if (isset($params)) {
            // var_dump($params);
        }
        echo $this->twig->render('contact/index.html.twig', [
            'data' => 'Bienvenue sur le controller Contact! ' . $params,
            'session' => $_SESSION
        ]);
    }
}
