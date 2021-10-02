<?php

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;

class Comments
{
    private ?int $id = null;
    private ?int $news_id= null;
    private ?int $commenter_id= null;
    private ?string $commenter_username= null;
    private ?string $comment= null;
    private ?string $update_date= null;
    private ?array $imageFile= null;

    public function load($data)
    {
        $this->id= $data['id'] ?? null;
        $this->title = $data['title'];
        $this->content= $data['content'];
        $this-> author = $data['author'];
        $this -> imageFile = $data['imageFile'];
        $this-> imagePath = $data['image'];
        
    }