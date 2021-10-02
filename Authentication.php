<?php

namespace app;

class Authentication
{

    public function setUserSession($username,$id,$role){
        $_SESSION['username'] = $username;
        $_SESSION['_id']= $id;
        $_SESSION['role'] = $role;
    }

    public static function getUserSessionInfo($value){
        return $_SESSION[$value];
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['username'])){
            return true;
        }else{
            return false;
        }
    }
    public function logOut()
    {
        if (isset($_SESSION['username'])){
            unset($_SESSION['username']);
            unset($_SESSION['_id']);
            unset($_SESSION['role']);
            session_destroy();
        }
    }





}


