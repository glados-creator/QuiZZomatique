<?php
include_once "../../Classes/Commun/commun.php";

$tmp = new Commun\commun();
if (!isset($_REQUEST["email"])) {

    //TODO voir possible erreur
    include_once "../commun/error.php";
    exit;
}
if ($tmp::is_login()){
    session_destroy();
}
session_start();
$_SESSION["user"] = new user($_REQUEST["email"],$_REQUEST["nom"]);
console_log("user created");
header('Location: '. ( (isset($_REQUEST["redirect"])? $_REQUEST["redirect"] : "index.php") ));
