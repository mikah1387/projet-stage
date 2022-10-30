<?php 

namespace App\Core;

use App\Controllers\MainController;

class Main 
{


       public function start()
       {
  
       // on demare la session 
        session_start();
        //http://localhost/Annonces_fr/Public/controlleur/methode/parametres
        // je reecrit de cette facon 
         //http://localhost/Annonces_fr/Public/index.php?p=controller/methode/parametres
        // on recuppere url 
         
         
                $params=[];

                if (isset($_GET['p'])  &&!empty($_GET['p']) ){
                 
              
               
                $params = explode('/',$_GET['p']);
               
                if ($params[0] !== ''){
                 
                    // on cree le controlleur de parm0;App\Controllers\Anooncescontoller
                    
                   $controller = '\\App\\Controllers\\'.ucfirst(array_shift($params)).'Controller';
              
                  
                  $controller = new $controller;
                  //on recupare le parm1 pour l'action si nom on envoie index
                  $action = (isset($params[0]))?array_shift($params):'index';
                   
                
                  if (method_exists($controller,$action)){

                     (isset($params[0]))? call_user_func_array([$controller,$action], $params) :  $controller->$action();
                  


                  }else{

                    http_response_code(404);
                    echo "page n'existe pas";
                  }
                
                   
                            }
                  } else{
               // on a pas de params on instancie controlleur par default;
                   // page d'accueil      
                       

                       $controller = new MainController;
                       $controller->index();
                
                         }
                       

    }

    
    

}