<?php

require 'Classes/autoloader.php';
Autoloader::register();
$tmp = new Commun\commun();
$tmp::commun(true);


// get_commun -> header html WOAW -> a faire en function
// commun + compt woaw 
// convertir commun en autoloader


// get action -> truc quizz -> a séparer en different fichier
// json + autoloader



// autoloader -> index.php et partout

// GET Action -> index.php

include_once "./src/index.php";
