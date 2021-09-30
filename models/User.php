<?php

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;

class User
{
    private ?int $id = null;
    private ?string $username= null;
    private ?string $firstname= null;
    private ?string $lastname= null;
    private ?string $email= null;
    private ?string $password= null;
    private ?string $passwordConfirm= null;
    private ?string $role= null;
    private ?int $num_posts= null;

    public function load($data)
    {
        $this->id= $data['id'] ?? null;
        $this->username = $data['username'];
        $this->firstname= $data['firstname'];
        $this-> lastname = $data['lastname'];
        $this -> email = $data['email'];
        $this-> password = $data['password'];
        $this-> role = $data['role'];
        $this-> num_posts = $data['num_posts'];
    }

    public function save()
    {
        $db = Database::$db;
        $errors = [];
        if (!$this->username || !$this->firstname || !$this->lastname || !$this->email || !$this->password || !$this->passwordConfirm){
            $errors[]= 'Please fill all the fields to register';
        }
        if ($this->password != $this->passwordConfirm){
            $errors[]= "Passwords don't match";
        }
        if ($db->isExist('users','email',$this->email)){
            $errors[] = "E-mail is already taken, please register with another one";
        }
        if ($db->isExist('users','username',$this->username)){
            $errors[] = "Username is already taken, please register with another one";
        }
        if(empty($errors)){

            if($this->id){
                $db->updateUser($this);
            }else{
                $db->createUser($this);
            }
        }  

        return $errors;

    }
}