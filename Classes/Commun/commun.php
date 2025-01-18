<?php
declare(strict_types=1);

namespace Commun;

session_start();


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
        if (commun::is_login()) {
            return;
        }
        echo "<h1>vous devez vous connecter</h1> <p><a href='index.php'>appuyer ici pour allez a l'acceuil</a></p>";
        echo "<p>";
        echo "<a href='connection.php'> appuyer ici pour vous connecter";
        echo "</a></p>";
        exit;
    }
}
    ?>
