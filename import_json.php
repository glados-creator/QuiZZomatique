<?php

include_once 'Classes/autoloader.php';

Autoloader::register();

if (php_sapi_name() === 'cli') {
    $options = getopt("", ["filePath:"]);

    $filePath = $options['filePath'] ?? '';
    echo $filePath;
    if (empty($filePath)) {
        echo "Usage: php load_json.php --filePath=FILE_PATH\n";
        exit(1);
    }

    DB\json::load($filePath);
}
?>
