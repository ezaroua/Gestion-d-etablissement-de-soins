<?php
// index.php
require_once 'config.php';
// Autres dépendances ou logique de routage

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('src/controllers/Router.php');

$router = new Router();
$router->routeReq();


