<?php

function infoAdmine(): void{

    if ($_SESSION["user"]->id !=null){
        echo '<p>'.$_SESSION["user"]->id.'</p>';
        echo '<p>'.$_SESSION["user"]->email.'</p>';
        echo '<p>'.$_SESSION["user"]->nom.'</p>';
        echo '<p>'.$_SESSION["user"]->prenom.'</p>';
        echo '<p>'.$_SESSION["user"]->password.'</p>';
    }
    else{
        echo"personne est connecter";
    }
}

function infoclient(): void{

    if ($_SESSION["user"]->id !=null){
        getAllUser();
    }
    else{
        echo"personne est connecter";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/style.css">
</head>
<body>
<h1>Bienvenue sur votre gestionnaire admin !!</h1>
    
        <section class="info">
            <?php infoAdmine(); ?>
        </section>


        <form action="answer.php" method="POST">
        <section>

        </section>
        </form>

</body>
</html>