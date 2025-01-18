<?php
declare(strict_types=1);

namespace Commun;

session_start();

include "Classes/DB/user.php";


if (!isset($_SESSION["user"])){
    $_SESSION['user'] = null;
}

if (!isset($_SESSION["BD"])){
    $_SESSION['BD'] = null;
    require "Classes/DB/create.php";
}


class commun {

    
    public static function footer(): void
    {
        include "footer.php";
    }
    
    public static function header(bool $navbar =true):void
    {
        include "header.php";
        if($navbar) {
            include "navbar.php";
        }
    }
    
    
    public static function commun(bool $navbar = true): void
    {
        commun::header($navbar);
    }
    

    public static function is_login(): bool
    {
        return (isset($_SESSION) && isset($_SESSION["user"]));
    }

    public static function must_login()
    {
        if (is_login()) {
            return;
        }
        include_once "../commun/commun.php";
        include_once "../commun/header.php";
        include_once "../commun/navbar.php";
        echo "<h1>vous devez vous connecter</h1> <p><a href='index.php'>appuyer ici pour allez a l'acceuil</a></p>";
        echo "<p>";
        echo "<a href='connection.php'> appuyer ici pour vous connecter";
        echo "</a></p>";
        include_once "../commun/footer.php";
        exit;
    }

}
    ?>
