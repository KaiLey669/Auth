<?php

//namespace App\Controllers;

require __DIR__ . '/UserModel.php';
//use App\Model\UserModel;

class UserController
{
    private const SALT = '32kd04f2dd6g4sqw1';
    private const USER_PASSWORD = 'log';
    private const USER_LOGIN= 'pass';
    private const USER_LOGIN_REG= 'reglog';

    public function controllerReg(string $login,string $password)
    {
        $encrypted_pass = md5($password . self::SALT);
        setcookie(self::USER_PASSWORD, $encrypted_pass, time() + 70);
        setcookie(self::USER_LOGIN_REG, $login, time() + 70);
        $model = new UserModel();
        $model->setAll($login, $encrypted_pass);
        $model->reg();
    }

    public function controllerLogin(string $login,string $password)
    {
        $encrypted_pass = md5($password . self::SALT);
        $model = new UserModel();
        $model->setAll($login, $encrypted_pass);
       if ($model->findUser() == true)
       {
           setcookie(self::USER_PASSWORD, $encrypted_pass, time() + 70);
           setcookie(self::USER_LOGIN, $login, time() + 70);
       }
    }

    public function controllerLogout()
    {
        setcookie(self::USER_PASSWORD, null, -1, '/');
        setcookie(self::USER_LOGIN, null, -1, '/');
        setcookie(self::USER_LOGIN_REG, null, -1, '/');
    }

    public function controllerFindUser(string $login,string $password)
    {
        $model = new UserModel();
        $model->setall($login, $password);
        return $model->findUser();
    }
}