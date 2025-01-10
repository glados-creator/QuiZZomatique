<?php 
session_destroy();
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    // echo "called directly";
    header('Location: '. ( (isset($_REQUEST["redirect"])? $_REQUEST["redirect"] : "index.php") ));
    die();
} else {
  ; // echo "included/required";
}
?>
