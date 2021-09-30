<?php
//This is a class which is created to help our system in purposes of utility.
namespace app\helpers;

class UtilHelper
{
    public static function randomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str= '';
        for ($i=0; $i < $n; $i++){
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }
        return $str;
    }
}