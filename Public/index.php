<?php

//constant de chemin dossier racine;

use App\AutoLoader;
use App\Core\Main;

define('ROOT', dirname(__DIR__));


require_once ROOT.'/AutoLoader.php';
AutoLoader::register();
// //on instancie Main notre routeur;

$app = new Main();

$app->start();
