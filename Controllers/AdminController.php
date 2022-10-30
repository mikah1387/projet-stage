<?php 

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Models\CommentsModel;
use App\Models\UsersModel;
use App\Models\ReservationsModel;

class AdminController extends Controller
{
     public function index()
     {

        // var_dump($_SESSION);
           if ($this->IsAdmin()){


            $annoncesmodel = new AnnoncesModel;
            $usersmodel = new UsersModel;
            $reservmodel = new ReservationsModel;
            $commentmodel = new CommentsModel;



            // select * from annonces join users on annonces.users_id = users.id
            $Allannonces = $annoncesmodel->findalljoin('users','users_id', 'id_users');
            $Allusers = $usersmodel->findall();
            $Allreservs = $reservmodel->findalljoin('users','users_id', 'id_users');
            $Allcomments = $commentmodel->findall();

            $this->render('admin/index',['annonces'=>$Allannonces,
                                          'users'=>$Allusers,
                                          'reservations'=>$Allreservs,
                                          'Allcomments'=>$Allcomments]);

           }
        
     }


      public function activeAnnonce(int $id)
      {
        if ($this->IsAdmin()){ 
        $annoncesmodel = new AnnoncesModel;
        $Allannonces = $annoncesmodel->find($id);
        
       if ($Allannonces){

         $annonce =  $annoncesmodel->Hydrate($Allannonces);
         $annonce->setActif(($annonce->getActif())? 0:1);
        //  var_dump($annonce);

         $annoncesmodel->Update($annonce,$id);

        }
      }
      }
      public function activeComment(int $id)
      {
        if ($this->IsAdmin()){
        $comment = new CommentsModel;
        $refcomment = $comment->find($id);
      
       if ($refcomment){
        
         $REFcomment =  $comment->Hydrate($refcomment);
         $REFcomment->setActif(($REFcomment->getActif())? 0:1);
         $comment->Update($REFcomment,$id);
        

        }}
      }
     


     public function IsAdmin()
     {
             // verifier si on est connecter et si le ROLE_admin est dans columne roles;

            if ( isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
             // on est admin 

             return true;

            }else{

              $_SESSION['flash']['erreur'] ="vous n'avez pas acces a cette zone !.";
             
              header('location: http://the-bbq-restaurant' );
               exit;

            }

     }

}