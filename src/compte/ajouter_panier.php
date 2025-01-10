<?php
include_once "../commun/commun.php";
array_push($_SESSION["user"]->panier, $glob[$_POST["add_panier"]]);
