<?php

use PDO;

class UserModel
{
    private $login;
    private $password;
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=auth;host=localhost', 'kailey', '12345');
    }

    public function setAll($login,$password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function reg()
    {
        $sql = "INSERT INTO allusers(login, password) VALUES ( '$this->login', '$this->password')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function findUser()
    {
        if ($this->password == '')
        {
            $sql = "SELECT * FROM allusers WHERE login = '$this->login'";
        }
        else
        {
            $sql = "SELECT * FROM allusers WHERE login = '$this->login' 
                          AND password = '$this->password'";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result =  $stmt->fetchAll();
        if (count($result)>0)
        {
            return(true);
        }
        else
        {
            return(false);
        }
    }
}