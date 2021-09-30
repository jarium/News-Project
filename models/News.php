<?php

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;

class News
{
    private ?int $id = null;
    private ?string $title= null;
    private ?string $content= null;
    private ?string $author= null;
    private ?string $create_date= null;
    private ?string $update_date= null;
    private ?array $imageFile= null;
    private ?string $comments= null;

    public function load($data)
    {
        $this->id= $data['id'] ?? null;
        $this->title = $data['title'];
        $this->content= $data['content'];
        $this-> author = $data['author'];
        $this -> imageFile = $data['imageFile'];
        $this-> imagePath = $data['image'];
    }

    public function save()
    {
        $errors = [];
        if (!$this->title){
            $errors[]= 'Title for the news is required';
        }
        if (!$this->content){
            $errors[]= 'Content for the news is required';
        }
        if (!$this->imageFile){
            $errors[] = 'Image for the news is required';
        }

        if (!is_dir(__DIR__.'/../public/images')){
            mkdir(__DIR__.'/../public/images');
        }

        if(empty($errors)){

            if ($this->imageFile && $this-> imageFile['tmp_name']){
                
                if ($this->imagePath){
                    unlink(__DIR__.'/../public/'.$this->imagePath);
                }

                $this-> imagePath= 'images/'.UtilHelper::randomString(8).'/'.$this->imageFile['name'];
                mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
                move_uploaded_file($this->imageFile['tmp_name'],__DIR__.'/../public/'.$this->imagePath);
            }

            $db = Database::$db;
            if($this->id){
                $db->updateNews($this);
            } else{
                $db->createNews($this);
            }
        }

        return $errors;

    }
}