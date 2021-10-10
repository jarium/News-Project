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

    public function getNews($search="",$admin=false, $api=false)
    { if($admin){
        if ($search){
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE title LIKE :title OR category LIKE :category OR author_username LIKE :author ORDER BY create_date DESC');
            $statement-> bindValue(':title', "%$search%");
            $statement-> bindValue(':author', "%$search%");
            $statement-> bindValue(':category', "%$search%");
        } else {
            $statement= $this->pdo->prepare('SELECT * FROM news ORDER BY create_date DESC');
        }

      }elseif($api){
        $statement = $this->pdo->prepare('SELECT _id, title, content, author_username, category, create_date, update_date FROM news WHERE isDeleted = 0 ORDER BY create_date DESC');
      }else{
        if ($search){
            $statement = $this->pdo->prepare('SELECT _id, title, content, image, author_username, category, create_date, update_date FROM news WHERE title LIKE :title AND isDeleted = 0 ORDER BY create_date DESC');
            $statement-> bindValue(':title', "%$search%");
        }else {
            $statement= $this->pdo->prepare('SELECT _id, title, content, image, author_username, category, create_date, update_date FROM news WHERE isDeleted = 0 ORDER BY create_date DESC');
        }
      }
      $statement-> execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsWithCategory($category,$search="")
    {
        if ($search){
            $statement = $this->pdo->prepare('SELECT _id, title, content, image, author_username, category, create_date, update_date FROM news WHERE title LIKE :title AND category = :category AND isDeleted = 0 ORDER BY create_date DESC');
            $statement->bindValue(':category',$category);
            $statement->bindValue(':title',"%$search%");
        }else{
            $statement = $this->pdo->prepare('SELECT _id, title, content, image, author_username, category, create_date, update_date FROM news WHERE category = :category AND isDeleted = 0 ORDER BY create_date DESC');
            $statement->bindValue(':category',$category);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsForUser($sql,$search="")
    {
        if ($search){
            $statement = $this->pdo->prepare("SELECT _id, title, content, image, author_username, category, create_date, update_date FROM news WHERE category IN ".$sql." AND title LIKE :title AND isDeleted = 0 ORDER BY create_date DESC");
            $statement->bindValue(':title',"%$search%");
        }else{
            $statement = $this->pdo->prepare("SELECT _id, title, content, image, author_username, category, create_date, update_date FROM news WHERE category IN ".$sql." AND isDeleted = 0 ORDER BY create_date DESC"); //SELECT ... FROM news WHERE category IN {(science, world, health, .......)} AND isDeleted= 0 ORDER BY create_date DESC
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id,$admin=false,$api=false)
    {
        if ($admin){
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE _id= :id');
        }elseif($api){
            $statement = $this->pdo->prepare('SELECT _id, title, content, author_username, category, create_date, update_date FROM news WHERE _id= :id AND isDeleted = 0');
        }else{
            $statement = $this->pdo->prepare('SELECT _id, title, content, image, author_username, category, create_date, update_date FROM news WHERE _id= :id AND isDeleted = 0');
        }
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function setUserNewsRead($user_id, $news_id)
    {
        $statement= $this->pdo->prepare("INSERT INTO users_read_news (users_id, news_id) VALUES (".$user_id.", ".$news_id.")");
        $statement->execute();
    }
    public function checkUserNewsRead($user_id, $news_id)
    {
        $statement= $this->pdo->prepare("SELECT _id FROM users_read_news WHERE users_id = ".$user_id." AND news_id = ".$news_id."");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserNewsRead($users_id, $search="")
    {
        if ($search){
            $statement = $this->pdo->prepare("SELECT news.title, news._id, users_read_news.read_date FROM users_read_news LEFT JOIN news ON news._id = users_read_news.news_id WHERE users_read_news.users_id = $users_id AND news.title LIKE :title AND news.isDeleted= 0 ORDER BY users_read_news.read_date DESC");
            $statement->bindValue(':title',"%$search%");
        }else{
            $statement = $this->pdo->prepare("SELECT news.title, news._id, users_read_news.read_date FROM users_read_news LEFT JOIN news ON news._id = users_read_news.news_id WHERE users_read_news.users_id = $users_id AND news.isDeleted= 0 ORDER BY users_read_news.read_date DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEditorNews($_id,$search = "")
    {
        if ($search){
            $statement = $this->pdo->prepare("SELECT _id, title, category, create_date, update_date FROM news WHERE author_id = :id AND title LIKE :title AND isDeleted = 0 ORDER BY create_date DESC");
            $statement->bindValue(':title',"%$search%");
        }else{
            $statement = $this->pdo->prepare("SELECT _id, title, category, create_date, update_date FROM news WHERE author_id = :id AND isDeleted = 0 ORDER BY create_date DESC");
        }
        $statement->bindValue(':id',$_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEditorNewsById($editor_id, $news_id)
    {
        $statement = $this->pdo->prepare("SELECT _id, title, category, content, image, create_date, update_date FROM news WHERE author_id = :id AND _id = :news_id AND isDeleted = 0");
        $statement->bindValue(':id',$editor_id);
        $statement->bindValue(':news_id', $news_id);
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

    public function deleteNews($_id,$soft=true)
    {   if ($soft == true){
            $statement = $this->pdo->prepare("UPDATE news SET isDeleted = 1, delete_date = :date WHERE _id = :id");
            $statement->bindValue(':id',$_id);
            $statement->bindValue(':date',date('Y-m-d H:i:s'));    
            $statement->execute();
        }else{
            $statement = $this->pdo->prepare('DELETE FROM news WHERE _id= :id');
            $statement->bindValue(':id',$_id);
            $statement->execute();
        }
    }
    public function restoreNewsById($_id)
    {
        $statement = $this->pdo->prepare("UPDATE news SET isDeleted = 0 WHERE _id = :id");
        $statement->bindValue(':id',$_id);    
        $statement->execute();
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
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE _id= :id AND isDeleted = 0');
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function getUsersByIdRole($id,$role)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE _id= :id AND role = :role AND isDeleted = 0");
        $statement->bindValue(':id',$id);
        $statement->bindValue(':role',$role);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function getUsersEditorsById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE _id= :id AND role IN ('editor', 'user') AND isDeleted = 0");
        $statement->bindValue(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllEditorUsers($search="")
    {
        if ($search){
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE role IN ('editor', 'user') AND isDeleted = 0 AND username LIKE :username ORDER BY create_date DESC");
            $statement->bindValue(':username',"%$search%");
        }else{
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE role IN ('editor', 'user') AND isDeleted = 0 ORDER BY create_date DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserCategories($_id)
    {
        $statement = $this->pdo->prepare("SELECT science, health, political, technology, world, economy, sports, art, education, social FROM users WHERE _id= ".$_id."");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserCategories($_id,$sql)
    {
        $statement = $this->pdo->prepare("UPDATE users SET ".$sql." WHERE _id = ".$_id."");
        $statement->execute();
    }

    public function getEditorCategories($_id)
    {
        $statement = $this->pdo->prepare("SELECT science, health, political, technology, world, economy, sports, art, education, social FROM editor_categories WHERE editor_id = :id");
        $statement->bindValue(':id',$_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateEditorCategories($_id,$sql)
    {
        $statement = $this->pdo->prepare("UPDATE editor_categories SET ".$sql." WHERE editor_id = :id");
        $statement->bindValue(':id',$_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser(User $user,$sql,$sql2)
    {
        $statement = $this->pdo->prepare("INSERT INTO users (username, firstname, lastname, email, password".$sql.") 
        VALUES (:username, :firstname, :lastname, :email, :password".$sql2.")");
        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':firstname', $user->firstname);
        $statement->bindValue(':lastname', $user->lastname);
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':password', password_hash($user->password,PASSWORD_DEFAULT));
        $statement->execute();
    }

    public function deleteUser($_id,$soft=false)
    {
        if ($soft == true){

            $statement= $this->pdo->prepare("UPDATE users SET delete_date = :date, isDeleted = 1 WHERE _id= :id");
            $statement2= $this->pdo->prepare("UPDATE comments SET delete_date = :date, isDeleted = 1 WHERE commenter_id= :id");
            $statement->bindValue(':id', $_id);
            $statement->bindValue(':date', date('Y-m-d H:i:s'));
            $statement2->bindValue(':date', date('Y-m-d H:i:s'));
            $statement2->bindValue(':id', $_id);
            $statement->execute();
            $statement2->execute();
        }else{
            $statement = $this->pdo->prepare("DELETE FROM users WHERE _id= ".$_id."");
            $statement2= $this->pdo->prepare("DELETE FROM comments WHERE commenter_id = ".$_id."");
            $statement->execute();
            $statement2->execute();
        }
    }

    public function getComments($newsId,$admin=false)
    {
        if ($admin){
            $statement = $this->pdo->prepare("SELECT * FROM comments ORDER BY create_date DESC");
        }else{
            $statement = $this->pdo->prepare("SELECT * FROM comments WHERE news_id = :news_id AND isDeleted= 0 ORDER BY create_date DESC");
            $statement -> bindValue(':news_id', $newsId);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCommentsByUserId($_id,$search="")
    {
        if ($search){ 
            $statement = $this->pdo->prepare("SELECT news.title, comments.commenter_id, comments.isAnon, comments.news_id, comments.comment, comments.create_date FROM comments LEFT JOIN news ON news._id = comments.news_id WHERE comments.commenter_id = $_id AND news.title LIKE :title AND comments.isDeleted= 0  AND news.isDeleted= 0 ORDER BY comments.create_date DESC");
            $statement-> bindValue(':title', "%$search%");
        }else{
            $statement = $this->pdo->prepare("SELECT news.title, comments.commenter_id, comments.isAnon, comments.news_id, comments.comment, comments.create_date FROM comments LEFT JOIN news ON news._id = comments.news_id WHERE comments.commenter_id = $_id AND comments.isDeleted= 0 AND news.isDeleted= 0 ORDER BY comments.create_date DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllComments($search="") //Mod
    {
        if ($search){ 
            $statement = $this->pdo->prepare("SELECT news.title, comments.* FROM comments LEFT JOIN news ON news._id = comments.news_id WHERE comments.comment LIKE :comment OR comments.commenter_username LIKE :username OR news.title LIKE :title ORDER BY comments.create_date DESC");
            $statement-> bindValue(':comment', "%$search%");
            $statement-> bindValue(':title', "%$search%");
            $statement-> bindValue(':username', "%$search%");
        }else{
            $statement = $this->pdo->prepare("SELECT news.title, comments.* FROM comments LEFT JOIN news ON news._id = comments.news_id ORDER BY comments.create_date DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentsById($_id) //Mod
    {     
        $statement = $this->pdo->prepare("SELECT news.title, comments.* FROM comments LEFT JOIN news ON news._id = comments.news_id WHERE comments._id = :id");
        $statement->bindValue(':id',$_id);    
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    public function createComment(Comments $comments)
    {
        $statement = $this->pdo->prepare("INSERT INTO comments (news_id, commenter_id, commenter_username, comment, isAnon)
        VALUES (:news_id, :commenter_id, :commenter_username, :comment, :isAnon)");
        $statement->bindValue(':news_id', $comments-> news_id);
        $statement->bindValue(':commenter_id', $comments->commenter_id);
        $statement->bindValue(':commenter_username', $comments->commenter_username);
        $statement->bindValue(':comment', $comments->comment);
        $statement->bindValue(':isAnon', $comments->isAnon);
        $statement->execute();
    }

    public function updateComment(Comments $comments){
        $statement = $this->pdo->prepare("UPDATE comments SET update_date = :update_date, comment = :comment WHERE _id = :id");
        $statement->bindValue(':comment', $comments->comment);
        $statement->bindValue(':update_date', $comments->update_date);
        $statement->bindValue(':id', $comments->id);
        $statement->execute();
    }

    public function deleteCommentsById($_id) //Mod
    {     
        $statement = $this->pdo->prepare("UPDATE comments SET isDeleted = 1, delete_date = :date WHERE _id = :id");
        $statement->bindValue(':id',$_id);
        $statement->bindValue(':date',date('Y-m-d H:i:s'));    
        $statement->execute();
    }

    public function restoreCommentsById($_id) //Mod
    {     
        $statement = $this->pdo->prepare("UPDATE comments SET isDeleted = 0 WHERE _id = :id");
        $statement->bindValue(':id',$_id);    
        $statement->execute();
    }

    public function loginCheck($username,$password)
    {
        $isDeleted= $this->getData('users','username',$username,'isDeleted');
        if ($isDeleted){
            return false;
        }else{
            $hashed_pass= $this->getData('users','username',$username,'password');
            $verify= password_verify($password,$hashed_pass);

            if ($verify == true) {
                return true;
            } 
            else {
                return false;
            }
        }
    }
    public function setEditorById($_id,$role,$promote=true,$username="")
    {
        if ($promote){
            $statement= $this->pdo->prepare("INSERT INTO editor_categories (editor_id, editor_username) VALUES (:id, :username)");
            $statement->bindValue(':id', $_id);
            $statement->bindValue(':username', $username);
            $statement->execute();
        }else{
            $statement= $this->pdo->prepare('DELETE FROM editor_categories WHERE editor_id = :id');
            $statement->bindValue(':id', $_id);
            $statement->execute();
        }
        $statement= $this->pdo->prepare("UPDATE users SET role = :role WHERE _id = :id AND isDeleted = 0");
            $statement->bindValue(':id', $_id);
            $statement->bindValue(':role', $role);
            $statement->execute();

    }
    public function setUserRoleById($_id,$role){//admin/mod
        $statement= $this->pdo->prepare("UPDATE users SET role = :role WHERE _id = :id AND isDeleted = 0");
        $statement->bindValue(':id', $_id);
        $statement->bindValue(':role', $role);
        $statement->execute();
    }
    public function getDeletedUsers($search="")
    {
        if ($search){
            $statement= $this->pdo->prepare("SELECT * FROM users WHERE role IN ('editor', 'user') AND username LIKE :username AND isDeleted = 1 ORDER BY delete_date DESC");
            $statement->bindValue(':username', "%$search%");
            $statement->bindValue(':role', "%$search%");
        }else{
            $statement= $this->pdo->prepare("SELECT * FROM users WHERE role IN ('editor', 'user') AND isDeleted = 1 ORDER BY delete_date DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }    
    

}