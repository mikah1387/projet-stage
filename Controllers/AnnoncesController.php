<?php

namespace App\Controllers;

use App\Core\Db;
use App\Models\AnnoncesModel;
use App\Controllers\AdminController;
use App\Core\Form;
use App\Models\CommentsModel;
use App\Models\ImageModel;
use App\Models\ImagesModel;
use App\Models\LikesModel;
use DateTime;

class AnnoncesController extends Controller
{

/**
 * une methode qui affiche les annonces de base donnee
 */

    public function index()
    {
      

      // include_once ROOT.'/Views/annonces/index.php';
        $annoncesmodel = new AnnoncesModel;

     //on vas chercher les annonces par categorie 
        $Menusentrees = $annoncesmodel->findby(['actif'=>1,'categorie'=>'entree']);

        foreach ($Menusentrees as  $annonce) {
         $idannonce = $annonce['id_annonces'];
         $imgmenuentree[] = $annoncesmodel->findalljoin('images','id_annonces','annonces_id    where id_annonces ='.$idannonce );

         }
         $Menusplats = $annoncesmodel->findby(['actif'=>1,'categorie'=>'plat']);
         foreach ($Menusplats  as  $annonce) {
          $idannonce = $annonce['id_annonces'];
          $imgmenuplat[] = $annoncesmodel->findalljoin('images','id_annonces','annonces_id    where id_annonces ='.$idannonce );
 
          }
          
          $Menusdesserts = $annoncesmodel->findby(['actif'=>1,'categorie'=>'dessert']);
          foreach ($Menusdesserts  as  $annonce) {
           $idannonce = $annonce['id_annonces'];
           $imgmenudessert[] = $annoncesmodel->findalljoin('images','id_annonces','annonces_id    where id_annonces ='.$idannonce );
  
       }
      $Menusboisson = $annoncesmodel->findby(['actif'=>1,'categorie'=>'boisson']);
      foreach ($Menusboisson  as  $annonce) {
       $idannonce = $annonce['id_annonces'];
       $imgmenuboisson[] = $annoncesmodel->findalljoin('images','id_annonces','annonces_id    where id_annonces ='.$idannonce );

       }
     // on genere la vue , on les envoie vers views/annonces/index.php
   

         $this->render('annonces/index', [ 'annonces'=>$Menusentrees,    'imgmenuentree'=> (!empty($imgmenuentree))?$imgmenuentree:'','imgmenuplat'=>$imgmenuplat,
         'imgmenudessert'=>$imgmenudessert,
         'imgmenuboisson'=>$imgmenuboisson
        ]);

   
     
    }


  public function lire(int $id)
 {
        //on instancie le model;   
        $annoncesmodel = new AnnoncesModel;
        $comment = new CommentsModel;
        $likes = new LikesModel;

      
      
        // on recupere lannonce par son id;
        $annoncebyid = $annoncesmodel->find($id);
        $imagebyannonce = $annoncesmodel->findalljoin('images','id_annonces','annonces_id where id_annonces ='.$id);

        // $annoncebyid = $annoncesmodel->findalljoin('images','id_annonces','annonces_id where id_annonces ='.$id);
        // on joint les commentaires a l'annonce est on recupere les ids des commentaire afin de recuperer les likes et dislikes 
        $commentannonce = $comment->findalljoin( 'annonces', 'annonces_id', 'id_annonces where id_annonces = '.$id);

        if($commentannonce){
          foreach ($commentannonce as  $value) {
            $idcomments[]= $value['id_comments'];
        };
          
          
            foreach ($idcomments as $idcomment) {
        
              $likesss[$idcomment]=$likes->findcount('lik',1,'comments_id',$idcomment);
              
              // ($likesss[$idcomment])?$likesss[$idcomment]:0;
              $dislikesss[$idcomment]=$likes->findcount('dislike',1,'comments_id',$idcomment);
              // ($dislikesss[$idcomment])?$dislikesss[$idcomment]:0;

              
        
            }

        }
        // on joint la table des comments a utilisateur
        $commentuser = $comment->findalljoin( 'users', 'users_id', 'id_users where annonces_id = '.$id.' and actif = 1');
      
        $likescomment = $likes->findalljoin('comments','comments_id','id_comments where annonces_id = '.$id);
      
        
        // on envoie a la vue ;
          $this->render('annonces/lire', [ 'annoncebyid'=>$annoncebyid, 'commentannonce'=>$commentannonce, 'commentuser'=>$commentuser,'likescomment'=>$likescomment,'likesss'=>(isset($likesss))?$likesss:'', 'dislikes'=>(isset($dislikesss))?$dislikesss:'','imagebyannonce'=> $imagebyannonce]);



 }

    // *******DELETE ANNONCE
      public function delete(int $id)
       {    
        
         $admin = new AdminController;
        
        if($admin->IsAdmin()){

        $deletearticle = new AnnoncesModel;
    
        // on recupere lannonce par son id;
          $deletearticle->Delete($id);
       // on envoie a la vue ;
          $this->render('annonces/delete');

       }
           //on instancie le model;   
           

      }
      public function PostImage(string $nameimage, $annonceid)
      {

        if(  !empty($_FILES[$nameimage])){

          $name = $_FILES[$nameimage]['name'];
          $type =  $_FILES[$nameimage]['type'];
          $size = $_FILES[$nameimage]['size'];
          $tmp = $_FILES[$nameimage]['tmp_name'];
          $error = $_FILES[$nameimage]['error'];

            $typeextentions = ['png', 'jpg', 'jpeg'];
            $types = ['image/png', 'image/jpg', 'image/jpeg'];

            $extention = explode('.', $name);
            $max_size = 50000000;


            if (in_array($type, $types)) {

                if (count($extention) <= 2  && in_array(strtolower(end($extention)), $typeextentions)) {

                  if ($size <= $max_size && $error == 0) {
                
                      $url_image = '/uploadimages/'. $name;
    
                        if (move_uploaded_file($tmp, 'C:/wamp64/www/Annonces_fr/Public'.$url_image)) {

                          $_SESSION['image']['success']=  "l'image telechargée";
                          } else {

                          $_SESSION['image']['erreur']= " image non telecharger";
                            }
                          } else {

                        $_SESSION['image']['erreur']= " image de grande taille or error = 1";
                          }
                      } else {

                          $_SESSION['image']['erreur']= " double extension ou type no present";
                      }
                    } else {

                        $_SESSION['image']['erreur']=  "type non autorise";
                        }
                }
                  $_POST[$nameimage] = isset($url_image )? $url_image :null;
                
                                        
                  $imagemodel = new ImagesModel;

                  $newimage= $imagemodel-> setName_image($name)
                                        ->setUrl_image($_POST[$nameimage] ) 
                                        ->setAnnonces_id($annonceid);
                                        $imagemodel->Create( $newimage);



      }

      public function updatePostImage(string $nameimage, $id)
    {

        if( !empty($_FILES[$nameimage])){

          

          $name = $_FILES[$nameimage]['name'];
          $type =  $_FILES[$nameimage]['type'];
          $size = $_FILES[$nameimage]['size'];
          $tmp = $_FILES[$nameimage]['tmp_name'];
          $error = $_FILES[$nameimage]['error'];

            $typeextentions = ['png', 'jpg', 'jpeg'];
            $types = ['image/png', 'image/jpg', 'image/jpeg'];

            $extention = explode('.', $name);
            $max_size = 50000000;


            if (in_array($type, $types)) {

                if (count($extention) <= 2  && in_array(strtolower(end($extention)), $typeextentions)) {

                  if ($size <= $max_size && $error == 0) {
                
                      $url_image = '/uploadimages/'. $name;
    
                        if (move_uploaded_file($tmp, 'C:/wamp64/www/Annonces_fr/Public'.$url_image)) {

                          $_SESSION['image']['success']=  "l'image telechargée";
                          } else {

                          $_SESSION['image']['erreur']= " image non telecharger";
                            }
                          } else {

                        $_SESSION['image']['erreur']= " image de grande taille or error = 1";
                          }
                      } else {

                          $_SESSION['image']['erreur']= " double extension ou type no present";
                      }
                    } else {

                        $_SESSION['image']['erreur']=  "type non autorise";
                        }
                }
                  $_POST[$nameimage] = isset($url_image )? $url_image :null;
                
                                        
                  $imagemodel = new ImagesModel;

                  $newimage= $imagemodel-> setName_image($name)
                                        ->setUrl_image($_POST[$nameimage] ); 
                                         
                                        $imagemodel->Update( $newimage,$id);
                                    
    }
  

    public function ajouter()
    {
      $admin= new AdminController;
      if($admin->IsAdmin()){
      $form = new Form;
          
    

      if ( Form::Validate($_POST, ['categorie','titre','detail','prix']))
      {

         $categorie = trim(strip_tags($_POST['categorie']));
         $titre = trim(strip_tags($_POST['titre'])); 
         $detail = trim (strip_tags($_POST['detail']));
         $prix = trim (strip_tags($_POST['prix']));

          // on stock l'annonce dans la base dd;

                            $annoncesmodel= new AnnoncesModel;
                            $NewArticle= $annoncesmodel->setCategorie($categorie)
                                                       ->setTitre($titre) 
                                                       ->setDetail($detail)
                                                       -> setPrix($prix)
                                                       
                                                       ->setUsers_id($_SESSION['user']['id']);
                                 
                                                    
  
                    
     
                                      $annoncesmodel->Create( $NewArticle);

                                       $lastannonce = (Db::getInstance())->lastInsertId();
                                      $this->PostImage('image1', $lastannonce);
            
                                      $this->PostImage('image2', $lastannonce);
                                      $this->PostImage('image3', $lastannonce);

                                     
                  
   
                    }else{

                     {
                      if ($_POST){
                        $_SESSION['flash']['erreur'] ="le formulaire est incomplet!!";
                        
                      }
                      $titre = isset($_POST['titre']) && !empty($_POST['titre']) ? strip_tags ($_POST['titre']):"";
                      $detail = isset($_POST['detail']) && !empty($_POST['detail']) ? strip_tags ($_POST['detail']):"";
                      
                     
                         }
                     }

                 
      $form->Debutform('POST','', ['class'=> 'form', 'enctype' =>"multipart/form-data"])
             ->Addlabel('categorie','Categorie')
             ->Addinput('text', 'categorie')
             ->Addlabel('titre','Titre')
             ->Addinput('text', 'titre',['value'=>$titre])
             ->Addlabel('prix','Prix ')
             ->Addinput('text','prix' )
             ->Addlabel('detail','Contenu')
             ->Addtextarea('detail',$detail)
            
             ->Addlabel('image1','telecharger une image')
             ->Addinput('file', 'image1')
             ->Addlabel('image2','telecharger une image')
             ->Addinput('file', 'image2')
             ->Addlabel('image3','telecharger une image')
             ->Addinput('file', 'image3')
           
             
             ->Addbutton('Ajouter', ['type'=>'submit','class'=>'btn btn_annonces'])
             ->Finform();
             
            
            $this->render('annonces/ajouter', [ 'ajoutermenu'=>$form->Create()] );


          }
    }

//************* MODIFICATIONS ANNONCES */

  public function modifier($id){
    //on instancie le model;   
    $message ="";

    $form = new Form;
    $imagemodel = new ImagesModel;      
     
    $admin = new AdminController;
     if($admin->IsAdmin())
     {
      if (Form::Validate($_POST, ['categorie','titre','detail','prix']))
    {
       $categorie = strip_tags ($_POST['categorie']);
       $titre = strip_tags ($_POST['titre']);
       $detail = strip_tags ($_POST['detail']);
       $prix = trim (strip_tags($_POST['prix']));
      
                  // $_POST['images'] = isset($url_image )? $url_image :null;
                  $_POST['date_creation']= date("Y-m-d H:i:s");
        // on stock l'utilisateur dans la base dd;
                     
     

                   

        $annoncesmodel= new AnnoncesModel;
        $imagesid = $imagemodel->findby(['annonces_id'=>$id]);
      

        $idimage1=$imagesid[0]['id_images'];
        $idimage2=$imagesid[1]['id_images'];
        $idimage3=$imagesid[2]['id_images'];
        

        $ChangeArticle= $annoncesmodel->setCategorie($categorie)
                                      ->setTitre($titre)
                                      ->setDetail($detail)
                                      ->setPrix($prix)
                                      -> setCreat_at( $_POST['date_creation']);
                                                     

                           
                          $annoncesmodel->Update( $ChangeArticle,$id);
                          // $lastannonce = (Db::getInstance())->lastInsertId();
                          $this->updatePostImage('image1', $idimage1);
                          $this->updatePostImage('image2', $idimage2);
                          $this->updatePostImage('image3', $idimage3);
                  
                   }else{

                  
                     if ($_POST){
                       $_SESSION['flash']['erreur'] ="le formulaire est incomplet!!";
                       
                     }
                   
                    }


    $form->Debutform('POST','', ['class'=> 'form', 'enctype' =>"multipart/form-data"])
           ->Addlabel('categorie','Categorie')
           ->Addinput('text', 'categorie')
           ->Addlabel('titre','titre')
           ->Addinput('text', 'titre')
           ->Addlabel('prix','Prix ')
           ->Addinput('text','prix' )
           ->Addlabel('detail','Contenu')
           ->Addtextarea('detail', '')
           ->Addlabel('image1','telecharger une image')
           ->Addinput('file', 'image1')
           ->Addlabel('image2','telecharger une image')
           ->Addinput('file', 'image2')
           ->Addlabel('image3','telecharger une image')
           ->Addinput('file', 'image3')
           
           ->Addbutton('Modifier ce menu', ['type'=>'submit','class'=>'btn'])
           ->Finform();
           
          
          $this->render('annonces/modifier', [ 'modifiermenu'=>$form->Create()] );




     }
     
    


}


}
