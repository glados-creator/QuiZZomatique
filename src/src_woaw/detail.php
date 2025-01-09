<?php
include_once("../commun/commun.php");
include_once("../commun/header.php");
include_once("../commun/navbar.php");

if (!isset($_REQUEST["detail_id"]) || !array_key_exists($_REQUEST["detail_id"],$glob)) {
    include_once("../commun/error.php");
    exit;
    }
echo "<div class='detail'>";
$obj = array($glob[$_REQUEST["detail_id"]]);
display_list(array("glob" => $obj));
echo "</div>";

include_once("../commun/footer.php");
?>