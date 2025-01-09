<?php
include_once("../commun/commun.php");
include_once("../commun/header.php");
include_once("../commun/navbar.php");
?>
<div class="main_container">
    <?php
    echo "<div class='main_container'>";
    $forbiden = [
        "id",
        "description",
        "discountPercentage",
        "rating",
        "stock",
        "brand",
        "category",
        "images"
    ];
    display_list(array(
        "forbiden" => $forbiden,
        "start_element" => function ($_) {
            echo "<div class='main_element'>"; },
        "end_element" => function ($_tmp) {
            echo "<form action='detail.php?detail_id=" . $_tmp["id"] . "' method='post'><input type='submit' value='detail'></form></div>"; }
    ));
    echo "</div>";
    ?>
</div>
<?php
include_once("../commun/footer.php");
?>