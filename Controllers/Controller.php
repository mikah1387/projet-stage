<?php
namespace App\Controllers;

abstract class Controller
{

  public function render( string $fichier, array $datas=[], string $template ='default')
  {
       
    //    var_dump($annonces);
       extract($datas);
      
       // on demarre un buffer de sortie;
      //  var_dump($datas);
       ob_start();

    
    require_once ROOT.'/Views/'.$fichier.'.php';
    
      
       $content = ob_get_clean();
     
      //  var_dump($content) ;
    // template de page ;
       require_once ROOT.'/Views/'.$template.'.php';
     

  }


 
}