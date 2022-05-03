<?php

require_once "../Router.php";
require_once "../functions.php";
class MovieController{

    public function login(Router $router){
        session_unset();
        if($_SERVER["REQUEST_METHOD"] =="GET"){
            $router->render("movies/login.php",['errors'=>[],'success'=>true]);
            exit;
        }
        if($_SERVER["REQUEST_METHOD"] =="POST"){
            $errors =[];
           $username = $_POST["username"];
           $password = $_POST["password"];
           if(!$username){
               $errors[] = "username is needed";
           }
           if(!$password){
            $errors[] = "password is needed";
            }
            if(empty($errors)){
                $data = $router->db->verifyLogin($username,$password);

                if(empty($data)){
                    $success = false;
                    $router->render("movies/login.php",['success' =>false]);
                }
                else{
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    header("Location:/movies");
                }
            }
            else{
                $router->render("movies/login.php",['errors'=>$errors,'success'=>true]);
            }
    }
    }
    public function register(Router $router){
        session_unset();
        if($_SERVER["REQUEST_METHOD"] =="GET"){
            $router->render("movies/register.php",['errors'=>[]]);
            exit;
        }
        if($_SERVER["REQUEST_METHOD"] =="POST"){
            $errors =[];
           $username = $_POST["username"];
           $password = $_POST["password"];
           $cfdPassword = $_POST["cfdPassword"];
           if(!$username){
               $errors[] = "username is needed";
           }
           if(!$password){
            $errors[] = "password is needed";
            }
            if($password!=$cfdPassword){
                $errors[] = "confirmed password doesn't match with password";
            }
            if(empty($errors)){
                $router->db->register($username,$password);
                header("Location:/");
            }
            else{
                $router->render("movies/register.php",['errors'=>$errors]);
            }
    }
    }
    public function index(Router $router){
        if(empty($_SESSION)){
            header("Location:/");
            exit;
        }
        $search = $_GET['search'] ?? '';
        $movies = $router->db->getMovies($search);
        $router->render("movies/moviesList.php",['movies' => $movies,'search'=>$search]);
    }
    public function create(Router $router){
        if(empty($_SESSION)){
            header("Location:/");
            exit;
        }
        $errors =[];
        $success = false;
        //$movie = ['title'=>'osfp','Description'=>'','rating'=>'','image'=>''];
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            $router->render("movies/addMovie.php",['errors'=>$errors,'success'=>$success]);
            exit;
        }


        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $success = false;
            $title = $_POST['Title'];
            $description = $_POST['Description'];
            $rating = $_POST['Rating'];
            $imagePath = $_POST['Image'] ?? 'images/large_movie_poster.png';
            $imageFile = $_FILES['Image'];
            if(!$title){
                $errors[] = 'A TITLE is NEEDED';
              }
            
            if(!$rating){
                $errors[] = 'A RATING is NEEDED';
              }
            if(empty($errors)){
                if(!is_dir('../public/images')){
                    mkdir('images');
                }
                if($imageFile["name"]!=""){
                    $imagePath='images/'.randString(10)."/".$imageFile['name'];
                    mkdir(dirname($imagePath));
                    move_uploaded_file($imageFile['tmp_name'],$imagePath);
                  }
                $movie = new movie($title,$description,$rating,$imagePath);
                $router->db->insertMovie($movie);
                $success = true;
                $router->render("movies/addMovie.php",['errors'=>$errors,'success'=>$success]);
                exit;
            }
            $router->render("movies/addMovie.php",['errors'=>$errors,'success'=>$success]);
        }
    }
    public function update(Router $router){
        if(empty($_SESSION)){
            header("Location:/");
            exit;
        }
        $success = false;
        $errors = [];
        if($_SERVER["REQUEST_METHOD"]=="GET" ){
            $id = $_GET['id']?? null;
            if (!$id){
                header("Location:/movies");
                exit;
            }
            $data = $router->db->retrieveData($id);
            $router->render("movies/updateMovie.php",['data'=>$data,'success'=>$success]);
        }
        if($_SERVER["REQUEST_METHOD"]=="POST" ){
            $id = $_POST['id'];
            if (!$id){
                header("Location:/movies");
                exit;
            }
            echo $id;
            $title = $_POST['Title'];
            $description = $_POST['Description'] ?? null;
            $rating = $_POST['rating'];
            //$imagePath = $_POST['Image'] ?? 'images/large_movie_poster.png';
            $imageFile = $_FILES['Image'];
            if(!$title){
                $errors[] = 'A TITLE is NEEDED';
              }
            
            if(!$rating){
                $errors[] = 'A RATING is NEEDED';
            }
            $oldimage = $router->db->retrieveData($id)['image'];
            $imagePath = "";
            if($imageFile["size"] != 0){
                if($oldimage!= "images/large_movie_poster.png"){
                  unlink($oldimage);
                  rmdir(dirname($oldimage));
                }
                $imagePath='images/'.randString(10)."/".$imageFile['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($imageFile['tmp_name'],$imagePath);
            }
            else{
                $imagePath = $oldimage;
            }
            $movie = new movie($title,$description,$rating,$imagePath);
            $router->db->updateMovie($movie,$id);
            header ("Location:/movies");
    }

    }
    public function delete($router){
        if(empty($_SESSION)){
            header("Location:/");
            exit;
        }
        $id = $_POST["id"];
        echo $id;
        $router->db->deleteMovie($id);
        header("Location:/movies");  
    }
}

?>