<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/src/Controller.php';
require __DIR__ . '/src/UserController.php';

require_once __DIR__ . '/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$loader = new FilesystemLoader(__DIR__ . '/views');
$twig = new Environment($loader);
$connection = new Controller($twig);
$userController = new UserController();
$login = (string)($_POST['login']);
$password = (string)($_POST['password']);


switch ($uri)
{
    case '/':
    {
        $connection->mainFormInvoke();
        break;
    }
    case '/auth':
    {
        if ($login != '' && $password != '')
        {
            $userController->controllerLogin($login, $password);
        }
        else
        {
            $connection->errorFormInvoke();
        }
        break;
    }

    case '/reg':
    {
        if ($login != '' && $password != '' && $userController->controllerFindUser($login, '') == false)
        {
            $userController->controllerReg($login, $password);
            header('Location: ' . 'http://206.189.15.220:91' . '/');
        }
        else
        {
            $connection->errorFormInvoke();
        }
        break;
    }

    case '/logout':
    {
        header('Location: ' . 'http://206.189.15.220:91' . '/');
        $userController->controllerLogout();
        break;
    }

    case '/exit':
    {
        header('Location: ' . 'http://206.189.15.220:91' . '/');
        break;
    }
}


if (isset($_COOKIE['log']))
{
    echo('Authorization is done. Login - ' . $_COOKIE['log'] . '.');
    $connection->loggedFormInvoke();
}

if (isset($_COOKIE['reglog']) && !isset($_COOKIE['log']))
{
    echo('Registration is done. Login - ' . $_COOKIE['reglog'] . '.');
}