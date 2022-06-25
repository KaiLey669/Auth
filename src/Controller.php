<?php

//namespace App\Controllers;

use Twig\Environment;

class Controller
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function mainFormInvoke()
    {
        echo $this->twig->render('main.html');
    }

    public function loggedFormInvoke()
    {
        echo $this->twig->render('logged.html');
    }

    public function errorFormInvoke()
    {
        echo $this->twig->render('error.html');
    }
}