<?php 

namespace App;
class AutoLoader
{
  static function register()
    {
        spl_autoload_register([
        __class__,
            'autoload'
        ]);        
    }
    static function autoload($class)
    {
       $class = str_replace(__NAMESPACE__.'\\', '',$class);
            
             $class = str_replace('\\', '/',$class);

             $fichier = __DIR__.'/'. $class. '.php';
             if (isset($fichier)){

                require_once $fichier;
             }
    }
}


