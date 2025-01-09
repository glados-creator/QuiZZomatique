<?php

declare(strict_types=1);

require 'Classes/autoloader.php';
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
    $DBFILE = "./test2.json";
    if (!file_exists($DBFILE)) {
        echo "<p>FILE NOT FOUND</p>";
        die("FILE NOT FOUND");
    }
    $glob = json_decode(file_get_contents($DBFILE), true);
    // var_dump($glob);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h1>correction</h1>";
        // echo json_encode($_POST);
    }
    
    foreach ($glob as $file) {
        foreach ($file as $factory => $inps) {
            if (!array_key_exists("options", $inps)) {
                $inps["options"] = array();
            }
            $correct = false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $correction = (new $factory(...$inps));
                array_push($inps["options"],"disabled");
                $inps["value"] = $_POST[$inps["name"]];
                try {
                    $correct = $correction->is_correct(strval($_POST[$inps["name"]]));
                    if ($inps["required"]){
                    if ($correct) {
                        $inps["style"] = "color : green;";
                    } else {
                        $inps["style"] = "color : red;";
                    }}
                } catch (\Throwable $th) {
                    echo $th->getMessage();
                    //throw $th;
                }
            }
            echo "<div class='question ".($_SERVER["REQUEST_METHOD"] == "POST" && $correct ? " correct " : " incorrect ")."'>";
            // print_r(json_encode($inps));
            $tmp = (new $factory(...$inps));
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if ($inps["required"]){
                    if ($correct){
                        echo "<p style='color : green;'>correct</p>";
                    } else {
                        echo "<p style='color : red;'>no</p>";
                    }
                }
            }
            echo $tmp;
            echo "</div>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>site autoloader PHP QUIZZ ANSWER</h1>
    <form action="answer.php" method="POST">
        <div class="questions">
            <?php main(); ?>
        </div>
    </form>

</body>
</html>