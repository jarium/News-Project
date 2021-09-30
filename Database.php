<?php
namespace app;

use PDO;
use app\models\News;

class Database
{
    public static Database $db;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=newspage','root','root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$db = $this;
    }

    public function isExist($table,$row,$data)
    {
        $statement= $this->pdo->prepare("SELECT * FROM $table WHERE $row = '$data'");
        $statement->execute();
            $Count = $statement -> rowCount();
            if ($Count > 0) {
                return True;
            } 
            else {
                return False;
            }
    }

    public function getNews($search="")
    {
        if ($search){
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE title LIKE :title ORDER BY create_date DESC');
            $statement-> bindValue(':title', "%$search%");
        } else {
            $statement= $this->pdo->prepare('SELECT * FROM news ORDER BY create_date DESC');
        }
        $statement-> execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM news WHERE id= :id');
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createNews(News $news)
    {
        $statement = $this->pdo->prepare("INSERT INTO news (title, content, author, image, create_date) 
        VALUES (:title, :content, :author, :image, :date)");
        $statement->bindValue(':title', $news-> title);
        $statement->bindValue(':image', $news->imagePath);
        $statement->bindValue(':content', $news->content);
        $statement->bindValue(':author', $news->author);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->execute();
    }

    public function deleteNews($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM news WHERE id= :id');
        $statement->bindValue(':id',$id);
        $statement->execute();
    }

    public function updateNews(News $news)
    {
        $statement = $this->pdo->prepare ("UPDATE news SET title = :title, 
                    image = :image, content= :content WHERE id= :id");

        $statement->bindValue(':title', $news->title);
        $statement->bindValue(':image', $news->imagePath);
        $statement->bindValue(':content', $news->description);
        $statement->bindValue(':id', $news->id);
        $statement->execute();
    }

    public function getUsers($search="")
    {
        if ($search){
            $statement = $this->pdo->prepare('SELECT * FROM users WHERE username LIKE :username ORDER BY create_date DESC');
            $statement-> bindValue(':username', "%$search%");
        } else {
            $statement= $this->pdo->prepare('SELECT * FROM users ORDER BY create_date DESC');
        }
        $statement-> execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id= :id');
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(News $news)
    {
        $statement = $this->pdo->prepare("INSERT INTO news (title, content, author, image, create_date) 
        VALUES (:title, :content, :author, :image, :date)");
        $statement->bindValue(':title', $news-> title);
        $statement->bindValue(':image', $news->imagePath);
        $statement->bindValue(':content', $news->content);
        $statement->bindValue(':author', $news->author);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->execute();
    }

    public function deleteUser($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM news WHERE id= :id');
        $statement->bindValue(':id',$id);
        $statement->execute();
    }

    public function updateUser(News $news)
    {
        $statement = $this->pdo->prepare ("UPDATE news SET title = :title, 
                    image = :image, content= :content WHERE id= :id");

        $statement->bindValue(':title', $news->title);
        $statement->bindValue(':image', $news->imagePath);
        $statement->bindValue(':content', $news->description);
        $statement->bindValue(':id', $news->id);
        $statement->execute();
    }
}