<?php

declare(strict_types=1);

include_once '../../Classes/autoloader.php';
Autoloader::register();

# button
# checkbox
# color
# date
# datetime
# email
# file
# hidden
# image
# month
# number
# password
# radio
# range
# reset
# search
# submit
# tel
# text
# time
# url
# week

function main(): void{
    $class_types = [
    "\\Form\\Type\\button" => ["button"]
    ,"\\Form\\Type\\checkbox" => ["checkbox"]
    ,"\\Form\\Type\\color" => ["color"]
    ,"\\Form\\Type\\date" => ["date"]
    ,"\\Form\\Type\\datetime" => ["datetime"]
    ,"\\Form\\Type\\email" => ["email"]
    ,"\\Form\\Type\\file" => ["file"]
    ,"\\Form\\Type\\hidden" => ["hidden"]
    ,"\\Form\\Type\\image" => ["image"]
    ,"\\Form\\Type\\month" => ["month"]
    ,"\\Form\\Type\\number" => ["number"]
    ,"\\Form\\Type\\password" => ["password"]
    ,"\\Form\\Type\\radio" => ["radio"]
    ,"\\Form\\Type\\range" => ["range"]
    ,"\\Form\\Type\\reset" => ["reset"]
    ,"\\Form\\Type\\search" => ["search"]
    ,"\\Form\\Type\\submit" => ["submit"]
    ,"\\Form\\Type\\tel" => ["tel"]
    ,"\\Form\\Type\\text" => ["text"]
    ,"\\Form\\Type\\time" => ["time"]
    ,"\\Form\\Type\\url" => ["url"]
    ,"\\Form\\Type\\week" => ["week"]
    ,"\\Form\\Type\\textarea" => ["textarea"]
    ];
    
    foreach ($class_types as $factory => $inps) {
        //TODO Corriger       
        echo new $factory(...$inps) ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>site autoloader PHP</h1>
    <form action="">
        <?php main(); ?>
    </form>

</body>
</html>