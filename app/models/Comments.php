<?php

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;

class Comments
{
    public ?int $id = null;
    public ?int $news_id= null;
    public ?int $commenter_id= null;
    public ?string $commenter_username= null;
    public ?string $comment= null;
    public ?string $create_date= null;
    public ?string $update_date= null;
    public ?int $isAnon= null;

    public function load($data)
    {
        $this->id= $data['_id'] ?? null;
        $this->news_id = $data['news_id'] ?? null;
        $this->commenter_username= $data['commenter_username'] ?? null;
        $this->commenter_id= $data['commenter_id'] ?? null;
        $this->update_date= $data['update_date'] ?? null;
        $this-> comment = htmlspecialchars(trim($data['comment']));
        $this-> isAnon = $data['isAnon'] ?? null;

    }

    public function save()
    {
        $helper = new UtilHelper;
        $db = Database::$db;
        $errors = [];
        if (!$this->comment){
            $errors[]= 'Please enter a comment';
        }
        if ($this->comment && !$helper->lengthValidation($this->comment,1,400)){
            $errors[]= 'Comment cannot be longer than 400 characters';
        }

        if(empty($errors)){
            if($this->id){
                $db->updateComment($this);
            } else{
                $db->createComment($this);
            }
        }  
        return $errors;
    }
    
}