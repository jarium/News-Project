<?php

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;

class News
{
    public ?int $id = null;
    public ?string $title= null;
    public ?string $content= null;
    public ?string $author= null;
    public ?string $create_date= null;
    public ?string $update_date= null;
    public ?array $imageFile= null;
    public ?string $imagePath= null;
    public ?int $author_id = null;
    public ?string $category= null;

    public function load($data)
    {

        $this->id= $data['_id'] ?? null;
        $this->title = $data['title'];
        $this->content= $data['content'];
        $this-> author = $data['author'];
        $this-> author_id = $data['author_id'];
        $this -> imageFile = $data['imageFile'];
        $this-> imagePath = $data['image'];
        $this-> category= $data['category'];
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
        if (!is_uploaded_file($this->imageFile['tmp_name']) && !$this->imagePath){
            $errors[] = 'Image for the news is required';
        }
        if ($this->category == 'Category...'){
            $errors[] = 'Category for the news is required';
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