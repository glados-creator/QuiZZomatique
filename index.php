<?php
include_once 'Classes/autoloader.php';
Autoloader::register();
$tmp = new Commun\commun();
$tmp::commun(true);


$action = isset($_GET['action']) ? $_GET['action'] : 'default';

switch ($action) {
    case 'account':
        include 'src/account.php';
        break;

    case 'quizz':
        include 'src/quizz.php';
        break;

    case 'create':
        include 'src/create.php';
        break;

    default:
        include 'src/index.php';
        break;
}

$tmp::footer();