<?php


require_once "../Router.php";
require_once "../controllers/MovieController.php";

session_start();

$mc = new MovieController();
$router = new Router();
$router->get('/', [$mc,'login']);
$router->get('/register', [$mc,'register']);
$router->post('/', [$mc,'login']);
$router->post('/register', [$mc,'register']);
$router->get('/movies', [$mc,'index']);
$router->get('/movies/moviesList', [$mc,'index']);
$router->get('/movies/create', [$mc,'create']);
$router->get('/movies/update', [$mc,'update']);
$router->post('/movies/create', [$mc,'create']);
$router->post('/movies/update', [$mc,'update']);
$router->get('/movies/delete', [$mc,'delete']);
$router->post('/movies/delete', [$mc,'delete']);

$router->resolve();





?>