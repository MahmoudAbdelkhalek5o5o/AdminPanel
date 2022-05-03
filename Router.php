<?php

require_once "database.php";

class Router{
    public array $getRoutes=[];
    public array $postRoutes=[];
    public Database $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        require_once ("controllers/MovieController.php");
        $currentURL = $_SERVER['PATH_INFO'] ?? "/";
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET"){
            $fn = $this->getRoutes[$currentURL] ?? null;
        }
        else{
            $fn = $this->postRoutes[$currentURL] ?? null;
        }
        if($fn){
            call_user_func($fn, $this);
            
        }
        else{
            echo 'page not found';
        }
}
    public function render($view,$params = []){
        foreach($params as $key=>$value){
             $$key=$value;
        }
        ob_start();
        include_once (__DIR__ . "/views/".$view);
        $content = ob_get_clean();
        include_once (__DIR__ . "/views/layout.php");
    }
}
?>