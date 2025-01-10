<?php

declare(strict_types=1);

namespace DB;

class loader_sql {
    public static function load() : array {
        $DBFILE = "./test2.json";
        if (!file_exists($DBFILE)) {
            echo "<p>FILE NOT FOUND</p>";
            die("FILE NOT FOUND");
        }
        $glob = json_decode(file_get_contents($DBFILE), true);
        return $glob;        
    }
}