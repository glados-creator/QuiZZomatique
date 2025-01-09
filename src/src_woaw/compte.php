<?php 
include_once("../commun/commun.php");
include_once("../commun/header.php");
include_once("../commun/navbar.php");

must_login();
?>

<h1>
    <?php echo $_SESSION["user"]->nom;?>
</h1>
<p>
    <?php echo $_SESSION["user"]->email;?>
</p>
<?php
include_once("../commun/footer.php");
?>