<?php

namespace app\models;

use app\Database;

class Comments
{
    public ?int $id = null;
    public ?int $news_id= null;
    public ?int $commenter_id= null;
    public ?string $commenter_username= null;
    public ?string $comment= null;
    public ?string $create_date= null;
    public ?int $isAnon= null;

    public function load($data)
    {
        $this->id= $data['id'] ?? null;
        $this->news_id = $data['news_id'];
        $this->commenter_username= $data['commenter_username'];
        $this->commenter_id= $data['commenter_id'];
        $this-> comment = $data['comment'];
        $this-> isAnon = $data['isAnon'];

    }

    public function save()
    {
        $db = Database::$db;
        $errors = [];
        if (!$this->comment){
            $errors[]= 'Please enter a comment';
        }

        if(empty($errors)){
            $db->createComment($this);
        }  
        return $errors;
    }
    
}