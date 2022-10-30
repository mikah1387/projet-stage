<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Core\Form;
use App\Models\UsersModel;
use App\Models\CommentsModel;
use App\Models\LikesModel;
use App\Core\Db;

class LikesController extends Controller
{
  
public function like($id)
{
    $addlike= new LikesModel;
     if(isset($_SESSION['user']))  {
   if ($this->isnot_liked($id) && $this->isnot_disliked($id) ){

    $postlike = $addlike->setLik(1)
                        
                        ->setComments_id($id)
                        
                         ->setUsers_id($_SESSION['user']['id']); 

       if( $addlike->Create($postlike) ){

         $_SESSION['flash']['success'] = " vous avez aimé(e) un commentaire";
      

       }

    }else if(!($this->isnot_disliked($id))){
     
      $likebyid = $addlike-> findby(['comments_id'=>$id, 'users_id'=>$_SESSION['user']['id'], 'dislike'=>1]);
      
      $id_like = $likebyid[0]['id_likes'];
       
      $postlike = $addlike->setLik(1)
                         ->setDislike(0);
                        
        if( $addlike->Update($postlike, $id_like) ){

          var_dump($postlike);

             $_SESSION['flash']['success'] = " vous avez aimé(e) un commentaire  ";


            }

      }
       else {

        $_SESSION['flash']['erreur'] = " vous avez déjas aimé(e) ce commentaire ";
    


     }
    } else{
      $_SESSION['flash']['erreur'] = " vous devez connecter pour aimer un commentaire";

    }
}

//****** dislike */
public function dislike($id)
{
    $adddislike= new LikesModel;
      if ($this->isnot_liked($id) && $this->isnot_disliked($id) ){
    
        $postlike = $adddislike->setDislike(1) 
                            ->setComments_id($id)
                             ->setUsers_id($_SESSION['user']['id']); 
    
           if( $adddislike->Create($postlike) ){
    
             $_SESSION['flash']['success'] = " vous detestez un commentaire ";
    
           }
    
        }else if(!($this->isnot_liked($id))){
     
          $dislikebyid = $adddislike-> findby(['comments_id'=>$id, 'users_id'=>$_SESSION['user']['id'], 'lik'=>1]);
          
          $id_like = $dislikebyid[0]['id_likes'];
           
          $postlike = $adddislike->setLik(0)
                                 ->setDislike(1);
                                
              

            if( $adddislike->Update($postlike, $id_like) ){
    
    
                 $_SESSION['flash']['success'] = " vous detestez un commentaire ";
    
    
                }
    
          }
        
        else {
    
        $_SESSION['flash']['erreur'] = " vous avez  déjas détesté ce commentaire ";
    
         }
}

public function delete(int $id)
{
      //on instancie le model;   
  $deletelike = new LikesModel;
 
  // on recupere lannonce par son id;
  $deletelike->Delete($id);
  // on envoie a la vue ;
  //  $this->render('likes/delete');


}

private function isnot_liked($id)
{

    $addlike= new LikesModel;
   $likebyid = $addlike-> findby(['comments_id'=>$id, 'users_id'=>$_SESSION['user']['id'], 'lik'=>1]);
   if(count($likebyid)>=1){

    return false;
      }
    return true;

}

private function isnot_disliked($id)
{

        $addlike= new LikesModel;
    $likebyid = $addlike-> findby(['comments_id'=>$id, 'users_id'=>$_SESSION['user']['id'], 'dislike'=>1]);
    if(count($likebyid)>=1){

        return false;
    }
    return true;

}

}