<?php

declare(strict_types=1);

class Autoloader {
   public static function register(){
      spl_autoload_register(array(__CLASS__,'autoload'));
      
   }

   public static function autoload($fqcn){
      $path = str_replace('\\', '/', $fqcn);
      try {
         require_once 'Classes/'.$path.'.php';
      }
      catch (Exception $e) {
         try {
            require_once '../../Classes/'.$path.'.php';
         }
         catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
         }
      }
}

}