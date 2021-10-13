<?php

namespace app;

use app\Authentication;

class Authorization extends Authentication
{
    public function getAuthLevel(){ //Yetkilendirme için seviyelendirme yapıyoruz
        $role= $this->getUserSessionInfo('role');
        if ($role){
        switch ($role){
            case 'user':
                $level = 1;
                break;
            case 'editor':
                $level = 2;
                break;
            case 'mod':
                $level = 3;
                break;
            case 'admin':
                $level = 4;
                break;
            }
        }
        return $level;  
    }
}