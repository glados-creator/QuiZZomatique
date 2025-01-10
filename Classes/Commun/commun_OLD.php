<?php
include_once("lib.php");
include_once("user.php");

session_start();

$DBFILE = "../data/product.json";
if (!file_exists($DBFILE)) {
    echo "<p>FILE NOT FOUND</p>";
    console_log("FILE NOT FOUND " . $DBFILE . "\n");
    die("FILE NOT FOUND");
}
$glob = json_decode(file_get_contents($DBFILE), true);
// var_dump($glob);

function display_list(array $template_arg): void
{
    global $glob;
    $real_args = $template_arg;

    // var_dump($real_args);
    // echo "<br>";
    // echo array_keys($real_args);
    $template = array(
        "forbiden" => array()
        ,
        "allowed" => array()
        ,
        "start_element" => function ($_tmp) {
            echo "<div class='element'>"; }
        ,
        "call_key" => function ($_tmp, $_tmp_key) {
            echo "<div>";
            if ($_tmp_key == "images") {
                echo "<img src=" . $_tmp[$_tmp_key][0] . " alt='img.png'>";
            } else {
                echo "$_tmp_key : $_tmp[$_tmp_key]";
            }
            echo "</div>";
        }
        ,
        "end_element" => function ($_tmp) {
            echo "</div>"; }
        ,
        "glob" => $glob
    );

    foreach ($template as $key => $value) {
        // try {
        //     //code...
        //     echo "<br>";
        //     print_r("TEST : " . $key . " : " . $value . " : " . (array_key_exists($key, $real_args) ? "true" : "false") . "");
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        if (!array_key_exists($key, $real_args)) {
            $real_args[$key] = $value;
            // print_r("replaced");
        }
    }
    echo "<br>";
    // var_dump($real_args);

    function inner_filter($filter_arg, $obj, $key): bool
    {
        $_band = true;
        $_allow_exist = false;
        $_allow = true;
        $_forbiden = false;
        if (isset($_GET["brand"]) && strtolower($_GET["brand"]) != strtolower($obj["brand"]))
            $_band = false;
        if ($filter_arg["allowed"]) {
            $_allow_exist = true;
            if (in_array(strtolower($key), $filter_arg["allowed"])) {
                $_allow = true;
            } else {
                $_allow = false;
            }
        }
        if ($filter_arg["forbiden"] && in_array(strtolower($key), $filter_arg["forbiden"])) {
            $_forbiden = true;
        }
        ;

        return !($_band && $_allow_exist ? ($_allow) : (!$_forbiden));
    }

    foreach ($real_args["glob"] as $obj) {
        echo $real_args["start_element"]($obj);
        foreach (array_keys($obj) as $key) {
            // console_log(strval($key)." : ".strval(inner_filter($arg,$obj,$key)));
            if (inner_filter($real_args, $obj, $key))
                continue;
            // echo "";
            $real_args["call_key"]($obj, $key);
            // echo "$key : ".$obj[$key];
        }
        echo $real_args["end_element"]($obj);
    }
}

function is_login(): bool
{
    return (isset($_SESSION) && isset($_SESSION["user"]));
}

function must_login()
{
    if (is_login()) {
        return;
    }
    include_once("../commun/commun.php");
    include_once("../commun/header.php");
    include_once("../commun/navbar.php");
    echo "<h1>vous devez vous connecter</h1> <p><a href='index.php'>appuyer ici pour allez a l'acceuil</a></p>";
    echo "<p>";
    echo "<a href='connection.php'> appuyer ici pour vous connecter";
    echo "</a></p>";
    include_once("../commun/footer.php");
    exit;
}
?>