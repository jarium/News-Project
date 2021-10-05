<?php
namespace app;

use PDO;
use app\models\News;
use app\models\User;
use app\models\Comments;

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
        $statement= $this->pdo->prepare("SELECT * FROM ".$table." WHERE ".$row." = :data");
        $statement->bindValue(':data',$data);
        $statement->execute();
            $count = $statement -> rowCount();
            if ($count > 0) {
                return True;
            } 
            else {
                return False;
            }
    }
    public function setData($table,$row,$data,$id)
    {
        $statement= $this->pdo->prepare("UPDATE :table SET :row = :data WHERE _id = :id");
        $statement-> bindValue(':table', $table);
        $statement-> bindValue(':row', $row);
        $statement-> bindValue(':data', $data);
        $statement-> bindValue(':id', $id);
        $statement->execute();
    
    }

    public function getData($table,$row,$data,$value)
    {
        $statement= $this->pdo->prepare("SELECT * FROM ".$table." WHERE ".$row." = :data");
        $statement-> bindValue(':data', $data);
        $statement->execute();
        while($assoc= $statement->fetch(PDO::FETCH_ASSOC)){
            return $assoc[$value];
        }
    }

    public function getNews($search="",$admin=false)
    { if($admin){
        if ($search){
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE title LIKE :title ORDER BY create_date DESC');
            $statement-> bindValue(':title', "%$search%");
        } else {
            $statement= $this->pdo->prepare('SELECT * FROM news ORDER BY create_date DESC');
        }
      }else{
        if ($search){
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE title LIKE :title AND isDeleted = 0 ORDER BY create_date DESC');
            $statement-> bindValue(':title', "%$search%");
        }else {
            $statement= $this->pdo->prepare('SELECT * FROM news WHERE isDeleted = 0 ORDER BY create_date DESC');
        }
      }
      $statement-> execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsWithCategory($category,$search="")
    {
        if ($search){
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE title LIKE :title AND category = :category AND isDeleted = 0 ORDER BY create_date DESC');
            $statement->bindValue(':category',$category);
            $statement->bindValue(':title',"%$search%");
        }else{
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE category = :category AND isDeleted = 0 ORDER BY create_date DESC');
            $statement->bindValue(':category',$category);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsForUser($sql,$search="")
    {
        if ($search){
            $statement = $this->pdo->prepare("SELECT * FROM news WHERE ".$sql." AND title LIKE :title AND isDeleted = 0 ORDER BY create_date DESC");
            $statement->bindValue(':title',"%$search%");
        }else{
            $statement = $this->pdo->prepare("SELECT * FROM news WHERE ".$sql." AND isDeleted = 0 ORDER BY create_date DESC"); //SELECT * FROM news WHERE {category = art OR category= tech OR......} AND isDeleted= 0 ORDER BY create_date DESC
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id,$admin=false)
    {
        if ($admin){
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE _id= :id');
        }else{
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE _id= :id AND isDeleted = 0');
        }
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createNews(News $news)
    {

        $statement = $this->pdo->prepare("INSERT INTO news (title, content, image, author_id, author_username, category)
        VALUES (:title, :content, :image, :author_id, :author_username, :category)");
        $statement->bindValue(':title', $news-> title);
        $statement->bindValue(':image', $news->imagePath);
        $statement->bindValue(':content', $news->content);
        $statement->bindValue(':author_id', $news->author_id);
        $statement->bindValue(':author_username', $news->author);
        $statement->bindValue(':category', $news->category);

        $statement->execute();
    }

    public function deleteNews($id,$soft=false)
    {   if ($soft == true){
            $this->setData('news','isDeleted',1,$id);
        }else{
            $statement = $this->pdo->prepare('DELETE FROM news WHERE _id= :id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    }

    public function updateNews(News $news)
    {
        $statement = $this->pdo->prepare ("UPDATE news SET title = :title, 
                    image = :image, content= :content, category = :category, update_date= :update_date WHERE _id= :id");

        $statement->bindValue(':title', $news->title);
        $statement->bindValue(':image', $news->imagePath);
        $statement->bindValue(':content', $news->content);
        $statement->bindValue(':category', $news->category);
        $statement->bindValue(':update_date', date('Y-m-d H:i:s'));

        $statement->bindValue(':id', $news->id);
        $statement->execute();
    }

    public function getUsers($search="") //Admin
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
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE _id= :id');
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserCategories($_id)
    {
        $statement = $this->pdo->prepare("SELECT science, health, political, technology, world, economy, sports, art, education, social FROM users WHERE _id= ".$_id."");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser(User $user)
    {
        $statement = $this->pdo->prepare("INSERT INTO users (username, firstname, lastname, email, password) 
        VALUES (:username, :firstname, :lastname, :email, :password)");
        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':firstname', $user->firstname);
        $statement->bindValue(':lastname', $user->lastname);
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':password', password_hash($user->password,PASSWORD_DEFAULT));
        $statement->execute();
    }
    public function createCategoryForUser($_id){
        $statement = $this->pdo->prepare("INSERT INTO user_categories (user_id) VALUES (".$_id.")");
        $statement->execute();
    }

    public function deleteUser($id,$soft=false)
    {
        if ($soft == true){
            $this->setData('users','isDeleted',1,$id);
        }else{
            $statement = $this->pdo->prepare("DELETE FROM users WHERE _id= :id");
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    }

    public function getComments($newsId,$admin=false)
    {
        if ($admin){
            $statement = $this->pdo->prepare("SELECT * FROM comments");
        }else{
            $statement = $this->pdo->prepare("SELECT * FROM comments WHERE news_id = $newsId AND isDeleted= 0");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCommentsByUserId($_id,$search="")
    {
        if ($search){
            $statement= $this->pdo->prepare("SELECT * FROM comments WHERE commenter_id = ".$_id." AND comment LIKE :comment ORDER BY create_date DESC");
            $statement-> bindValue(':comment', "%$search%");
        }else{
            $statement= $this->pdo->prepare("SELECT * FROM comments WHERE commenter_id = ".$_id." ORDER BY create_date DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentsCountByUserId($_id)
    {
        $statement= $this->pdo->prepare("SELECT * FROM comments WHERE commenter_id = ".$_id."");
        $statement->execute();
        $statement->fetchAll(PDO::FETCH_ASSOC);
        $count = $statement->rowCount();
        return $count;
    }

    public function getCommentsCountByNewsId($_id)
    {
        $statement= $this->pdo->prepare("SELECT * FROM comments WHERE news_id = :news_id");
        $statement->bindValue(':news_id',$_id);
        $statement->execute();
        $statement->fetchAll(PDO::FETCH_ASSOC);
        $count = $statement->rowCount();
        return $count;
    }

    public function createComment(Comments $comments)
    {
        $statement = $this->pdo->prepare("INSERT INTO comments (news_id, newsTitle, commenter_id, commenter_username, comment, isAnon)
        VALUES (:news_id, :newsTitle, :commenter_id, :commenter_username, :comment, :isAnon)");
        $statement->bindValue(':news_id', $comments-> news_id);
        $statement->bindValue(':newsTitle', $comments-> newsTitle);
        $statement->bindValue(':commenter_id', $comments->commenter_id);
        $statement->bindValue(':commenter_username', $comments->commenter_username);
        $statement->bindValue(':comment', $comments->comment);
        $statement->bindValue(':isAnon', $comments->isAnon);
        $statement->execute();
    }

    public function loginCheck($username,$password)
    {
        $hashed_pass= $this->getData('users','username',$username,'password');
        $verify= password_verify($password,$hashed_pass);

        if ($verify == true) {
            return true;
        } 
        else {
            return false;
        }
    }
    public function promoteUserById($_id,$role){//admin/mod
        if ($role == 'editor'){
            $statement= $this->pdo->prepare("INSERT INTO editor_categories (editor_id) VALUES $_id");
            $statement->execute();
        }
        $this->setData('users','role',$role,$_id);
    }

}