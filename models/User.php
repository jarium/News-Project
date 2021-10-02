<?php

namespace app\models;

use app\Database;
use app\Authentication;

class User
{
    public ?int $id = null;
    public ?string $role= null;
    public ?string $username= null;
    public ?string $firstname= null;
    public ?string $lastname= null;
    public ?string $email= null;
    public ?string $password= null;
    public ?string $password_confirm= null;

    public function load($data)
    {
        $this->id= $data['_id'] ?? null;
        $this->id= $data['role'] ?? null;
        $this->username = $data['username'];
        $this->firstname= $data['firstname'];
        $this-> lastname = $data['lastname'];
        $this -> email = $data['email'];
        $this->password= $data['password'];
        $this->password_confirm= $data['password_confirm'];
    }
    public function loadLoginInfo($data)
    {
        $this->username = $data['username'];
        $this->password= $data['password'];
    }


    public function save()
    {
        $db = Database::$db;
        $errors = [];
        if (!$this->username || !$this->firstname || !$this->lastname || !$this->email || !$this->password || !$this->password_confirm){
            $errors[]= 'Please fill all the fields to register';
        }
        if ($this->password != $this->password_confirm){
            $errors[]= "Passwords don't match";
        }
        if ($db->isExist('users','email',$this->email)){
            $errors[] = "E-mail is already taken, please register with another one";
        }
        if ($db->isExist('users','username',$this->username)){
            $errors[] = "Username is already taken, please register with another one";
        }
        if(empty($errors)){

            $db->createUser($this);
        }  

        return $errors;

    }
    public function saveLoginInfo()
    {
        $db = Database::$db;
        $errors = [];
        if (!$this->username || !$this->password){
            $errors[]= 'Please fill all the fields to login';
        }
        if ($db->loginCheck($this->username, $this->password) == false){
            $errors[]= "Either there is no such user or your password is wrong";
        }
        if(empty($errors)){
            $this->id= $db->getData('users','username',$this->username,'_id');
            $this->role= $db->getData('users','username',$this->username,'role');

            $authentication = new Authentication;
            $authentication->setUserSession($this->username,$this->id,$this->role);
        }

        return $errors;
    }
}