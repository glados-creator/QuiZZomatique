<?php 
declare(strict_types=1);
namespace commun;

function footer(): void
{
    include_once("./footer.php");
}

function header(bool $navbar =true):void
{   
    include_once("./header.php");
    if($navbar) {
        include_once("./navbar.php");
    }
}


function commun(bool $navbar): void
{
header($navbar);
// autoloader
require 'Classes/autoloader.php';
Autoloader::register();
}

?>