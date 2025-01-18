<?php

class Autoloader {
   public static function register() {
      spl_autoload_register(array(__CLASS__, 'autoload'));
   }

   public static function autoload($fqcn) {
      print $fqcn . "\n";
      if ($fqcn === 'PDO') {
         return;
      }
      if (class_exists($fqcn, false)) {
         return;
      }
      $path = str_replace('\\', '/', $fqcn);
      require 'Classes/' . $path . '.php';
   }
}
