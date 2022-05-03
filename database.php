<?php

require_once "model/movie.php";
class database{
    public PDO $pdo;
    public function __construct(){
        $this->pdo = new PDO ('mysql:host=localhost;port=3306;dbname=movies;','root','');
        $this->pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function register($username,$password){
        $query = $this->pdo->prepare("insert into admins (username,password) values (:username,:password)");
        $query->bindValue (':username',$username);
        $query->bindValue (':password',$password);
        $query->execute();
    }

    public function verifyLogin($username,$password){
        $query = $this->pdo->prepare("Select * from admins where username=:username and password=:password");
        $query->bindValue (':username',$username);
        $query->bindValue (':password',$password);
        $query->execute();
        $data = $query->fetch();
        return $data;
    }

    public function getMovies($search = ''){
        if(!$search){
            $query = $this->pdo->prepare("Select * from movies");
        }
        else{
            $movieName= $_GET["search"];
            $query = $this->pdo->prepare("Select * from movies where title Like :title");
            $query->bindValue(':title',"%$movieName%");
        }
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function insertMovie(movie $movie){
        $query = $this->pdo->prepare("insert into movies (title,Description,image,rating) values (:title,:description, :image, :rating)");
        $query->bindValue(':title',$movie->title);
        $query->bindValue(':image',$movie->imagePath);
        $query->bindValue(':rating',$movie->rating);
        $query->bindValue(':description',$movie->description);
        $query->execute();
    }
    public function updateMovie(movie $movie,$id){
        $query = $this->pdo->prepare("update movies set title = :title, image = :image, rating = :rating, Description =:description where id =:id");
        $query->bindValue(':id',$id);
        $query->bindValue(':title',$movie->title);
        $query->bindValue(':image',$movie->imagePath);
        $query->bindValue(':rating',$movie->rating);
        $query->bindValue(':description',$movie->description);
        $query->execute();
    }
    public function deleteMovie($id){
        $queryImage = $this->pdo->prepare("select image from movies where id = :id");
        $queryImage->bindValue(':id',$id);
        $queryImage->execute();
        $image = $queryImage->fetch();
        $imagePath = $image['image'];
        if($imagePath!="images/large_movie_poster.png"){
        unlink($imagePath);
        rmdir(dirname($imagePath));}
        $query = $this->pdo->prepare("delete from movies where id = :id");
        $query->bindValue(':id',$id);
        $query->execute();
    }
    public function retrieveData($id){
        $query = $this->pdo->prepare("select * from movies where id = :id");
        $query->bindValue(':id',$id);
        $query->execute();
        return $query->fetch();
    }
    public function checkUsername($username){
        $query = $this->pdo->prepare("select * from admins where username = :username");
        $query->bindValue(':username',$username);
        $query->execute();
        return $query->fetchAll();
    }
}
?>