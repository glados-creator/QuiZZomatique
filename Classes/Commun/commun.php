<?php 
declare(strict_types=1);


namespace commun;

class commun {

    
    public static function footer(): void
    {
        include_once("./footer.php");
    }
    
    public static function header(bool $navbar =true):void
    {   
        include_once("./header.php");
        if($navbar) {
            include_once("./navbar.php");
        }
    }
    
    
    public static function commun(bool $navbar): void
    {
        header($navbar);
        
        // autoloader
    }
    
}
    ?>