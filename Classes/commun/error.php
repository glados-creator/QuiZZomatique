<?php 
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    // echo "called directly";
    header('Location: '. ( (isset($_REQUEST["redirect"])? $_REQUEST["redirect"] : "index.php") ));
    die();
} else {
  ; // echo "included/required";

include_once("../commun//commun.php");
include_once("../commun//header.php");
include_once("../commun//navbar.php");
echo "<h1>Une erreur est survenue</h1> <a href='index.php'>appuyer ici pour allez a l'acceuil</a>";
include_once("../commun/footer.php");
exit;
}
?>
