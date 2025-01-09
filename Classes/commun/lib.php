<?php
function console_log($message) {
    // https://stackoverflow.com/questions/1889498/php-output-to-command-line
    $STDERR = fopen("php://stderr", "w");
              fwrite($STDERR, $message."\n");
              fclose($STDERR);
}