<?php

//
require_once '../../autoloader.php';
Autoloader::register();
$tmp = new Commun\commun();
//

must_login();
?>

<h1>
    <?php echo $_SESSION["user"]->nom;?>
</h1>
<p>
    <?php echo $_SESSION["user"]->email;?>
</p>
<?php
$tmp::footer();
?>
