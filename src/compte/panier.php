<?php 
include_once("../commun/commun.php");
include_once("../commun/header.php");
include_once("../commun/navbar.php");

must_login();

echo "<table>";
echo("<th>");
$panier_headers = array();
foreach ($_SESSION["user"]->panier as $key => $value) {
    foreach ($value as $key2 => $value2) {
        $panier_headers[$key2] = 0;
    }
}
foreach ($panier_headers as $key => $value) {
    echo "<td>";
    echo $key;
    echo "</td>";
}
echo("</th>");
foreach ($_SESSION["user"]->panier as $key => $value) {
    echo "<tr>";
    echo "<td><form action='src/panier_delete=" . $value["id"] . "' method='post'><input type='submit' name='delete'></form></div></td>";
    
    foreach ($value as $key2 => $value2) {
        echo "<td>". $value2 ."</td>";
    }
    
    echo "</tr>";
}
echo "</table>";

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

include_once("../commun/footer.php");
?>