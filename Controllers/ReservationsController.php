<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\ReservationsModel;
use App\Models\UsersModel;
use App\Core\Db;


class ReservationsController extends Controller
{
     public function index()
     {

            $this->render('reservations/index');
      
     }

     public function reserver()
     {
        $form = new Form;
        $reserv = new ReservationsModel;
        $user = new UsersModel;
      
        if (!empty($_SESSION['user'])){

        if (Form::Validate($_POST, ['nombres', 'demande', 'date_reservation', 'heure'])) {
           $nombres = strip_tags($_POST['nombres']);
           $demande = strip_tags($_POST['demande']);
           $date = strip_tags($_POST['date_reservation']);
           $heure = strip_tags($_POST['heure']);
           // envoie du mail
           
     
           $postreserv =  $reserv-> setNombres($nombres)
                   ->setDemande($demande)
                   ->setDate_reservation($date)
                   ->setHeure($heure)
                   ->setEtat(1)
                   ->setUsers_id($_SESSION['user']['id']);
                   $reserv->Create($postreserv) ;  
                   $lastreserv = (Db::getInstance())->lastInsertId();
                     if ($lastreserv){

                     $to='achache.hakim@gmail.com';
                     $to2=$_SESSION['user']['email'];
                     $subject = " Nouvelle Réservation N° $lastreserv pour le $date "; 

                     $message =  '<table >
                    <thead  >
                
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">Ref_Reservation</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">NOM</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">PRENOM</th>
                   
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">DATE_RESERVATIONS</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">HEURE</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">NOMBRE_PERSONNES</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">DEMANDE</th>
                    <th style="border: 2px solid #B19D61; background:#B19D61 ; ">EMAIL</th>
                    </thead>
                    <tbody  >
                    <tr>
                    <td style=" border: 2px solid #B19D61;"> '.$lastreserv.' </td>
                    <td style=" border: 2px solid #B19D61;"> '.$_SESSION['user']['lastname'].' </td>
                    <td style=" border: 2px solid #B19D61;"> '.$_SESSION['user']['firstname'].' </td>
                    
                    <td style=" border: 2px solid #B19D61;"> '. $date.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$heure.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$nombres.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$demande.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$_SESSION['user']['email'].'</td>
                    </tr>

                    </tbody>
                    </table>';
                    $message1 =   '<strong> vous avez une reservation de '.$_SESSION['user']['lastname'].' '.$_SESSION['user']['firstname'] .', ci-dessous les details. </strong> <br><br><br>'.$message ;

                    $message2 =   '<strong> Cher '.$_SESSION['user']['lastname'].' '.$_SESSION['user']['firstname'] .', nous vous remercions d’avoir réserver dans notre établissement, ci-dessous les détails de votre réservation.  </strong>
                    <br><br><br>'.$message;
                    
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                    $headers[] = 'From: '.$_SESSION['user']['email'];
                      
                     if (in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
                      if(mail($to,$subject,$message1, implode("\r\n", $headers)) ){
                        $_SESSION['flash']['success'] = "Bravo votre Reservation est enregistrée";
           
                        }else{
                        $_SESSION['flash']['success'] = "votre Reservation n'est pas enregistrée";
           
                       }

                     }else{
                      if(mail($to,$subject,$message1, implode("\r\n", $headers)) && mail($to2,$subject,$message2, implode("\r\n", $headers))){
                        $_SESSION['flash']['success'] = "Bravo votre Reservation est enregistrée";
           
                        }else{
                        $_SESSION['flash']['success'] = "votre Reservation n'est pas enregistrée";
           
                       }

                     }

                  
              
                   }
                  
                  
                 
               
            } else {

               if ($_POST) {
                     $_SESSION['flash']['erreur']= "Le formulaire est incomplet!! ";
                 }
         }


       $form->Debutform('POST', '', ['class' => 'form'])
      
           ->Addlabel('nombres', 'Nombre de personnes')
           ->Addinput('number', 'nombres',['min'=> 1])
           ->Addlabel('demande','Demande')
           ->Addtextarea('demande')
           ->Addlabel('date_reservation', 'Date de reservation')
           ->Addinput('date', 'date_reservation')
           
           ->Addlabel('heure', 'Heure')
       //     ->Addinput('time', 'heure')
           ->Addselect('heure',  ['11:45' =>'11:45','12:15' =>'12:15','12:30' =>'12:30','19:30' =>'19:30',
                                 '20:30' =>'20:30','21:00' =>'21:00','21:30' =>'21:30'])
           ->Addbutton('Je reserve', ['type' => 'submit', 'class' => 'btn'])
           ->Finform();


       $this->render('reservations/reserver', ['reserverform' => $form->Create()]);

       }else{
       $_SESSION['flash']['erreur'] = 'Vous devez vous connecter ou vous inscrire avant de reserver';
       $this->render('reservations/reserver');


       }
}

//*************MODIFIER UNE RESERVATIONS */  
       

     public function modifier($id)
{

  $form = new Form;
  $reserv = new ReservationsModel;
  // $allreserv= $reserv->find($id);
  $Allreservs = $reserv->findalljoin('users','users_id', 'id_users and id_reservations = '.$id);
 
 
  foreach ($Allreservs as $Allreserv) {
    
    $user_id = $Allreserv['users_id'];
    $name=$Allreserv['lastname'];
    $firstname =$Allreserv['firstname'] ;
    $email= $Allreserv['email'];

 };
  
  
 
  // $id_reservation=$allreserv['id_reservations'];

  if (!empty($_SESSION['user']) && (($_SESSION['user']['id']== $user_id)||in_array('ROLE_ADMIN', $_SESSION['user']['roles'])))
  {

  if (Form::Validate($_POST, ['nombres', 'demande', 'date_reservation', 'heure'])) {
      $nombres = strip_tags($_POST['nombres']);
      $demande = strip_tags($_POST['demande']);
      $date = strip_tags($_POST['date_reservation']);
      $heure = strip_tags($_POST['heure']);
   
    
      $_POST['date_creation']= date("Y-m-d H:i:s");


      $Changereserv =   $reserv->setId_reservations($id)
                               -> setNombres($nombres)
                               -> setDemande($demande)
                               ->setDate_creation($_POST['date_creation'])
                               -> setDate_reservation($date)
                               ->setHeure($heure)
                               ->setEtat(1)
                               ->setUsers_id($user_id);
                              //  $reserv->Update( $Changereserv,$id);
                         if ($reserv->Update( $Changereserv,$id) )  {
                           
                     $to='achache.hakim@gmail.com';
                     $to2=$_SESSION['user']['email'];
                     $subject = " Modification du Réservation N° $id pour le $date "; 

                     $message =  '<table >
                    <thead  >
                
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">Ref_Reservation</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">NOM</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">PRENOM</th>
                   
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">DATE_RESERVATIONS</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">HEURE</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">NOMBRE_PERSONNES</th>
                    <th style=" border: 2px solid #B19D61;background:#B19D61 ; ">DEMANDE</th>
                    <th style="border: 2px solid #B19D61; background:#B19D61 ; ">EMAIL</th>
                    </thead>
                    <tbody  >
                    <tr>
                    <td style=" border: 2px solid #B19D61;"> '.$id.' </td>
                    <td style=" border: 2px solid #B19D61;"> '.$name.' </td>
                    <td style=" border: 2px solid #B19D61;"> '.$firstname.' </td>
                    
                    <td style=" border: 2px solid #B19D61;"> '. $date.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$heure.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$nombres.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$demande.'</td>
                    <td style=" border: 2px solid #B19D61;">'.$email.'</td>
                    </tr>

                    </tbody>
                    </table>';
                    $message1 =   '<strong> vous avez une modification du  reservation de '.$name.' '.$firstname .', ci-dessous les details. </strong> <br><br><br>'.$message ;

                    $message2 =   '<strong> Cher '.$_SESSION['user']['lastname'].' '.$_SESSION['user']['firstname'] .', nous vous informions que votre réservation a été modifiée, ci-dessous les détails de votre réservation modifier.  </strong>
                    <br><br><br>'.$message;
                    
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                    $headers[] = 'From: '.$_SESSION['user']['email'];
                      
                     if (in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
                      if(mail($to,$subject,$message1, implode("\r\n", $headers)) ){
                        $_SESSION['flash']['success'] = "Bravo votre Reservation est modifiée, vérifier votre email";
           
                        }else{
                        $_SESSION['flash']['success'] = "votre Reservation est modifier mais le mail  n'est pas passé";
           
                       }

                     }else{
                      if(mail($to,$subject,$message1, implode("\r\n", $headers)) && mail($to2,$subject,$message2, implode("\r\n", $headers))){
                        $_SESSION['flash']['success'] = "Bravo votre Reservation est modifiée";
           
                        }else{
                        $_SESSION['flash']['success'] = "votre Reservation n'est pas modifiée";
           
                       }

                     }

                         } 
         
          

        } else {

                   if ($_POST) {
                $_SESSION['flash']['erreur']= "Le formulaire est incomplet!! ";
                   }
      }

                  // formulaire de modification
             $form->Debutform('POST', '', ['class' => 'form'])
                  ->Addlabel('nombres', 'Nombre de personnes')
                   ->Addinput('number', 'nombres',['min'=> 1])
                  ->Addlabel('demande','Demande')
                  ->Addtextarea('demande')
                  ->Addlabel('date_reservation', 'Date de reservation')
                  ->Addinput('date', 'date_reservation')
                   ->Addlabel('heure', 'Heure')
                   ->Addselect('heure',  ['11:45' =>'11:45','12:15' =>'12:15','12:30' =>'12:30','19:30' =>'19:30',
                                 '20:30' =>'20:30','21:00' =>'21:00','21:30' =>'21:30'])
                   ->Addbutton('modifier', ['type' => 'submit', 'class' => 'btn'])
                  ->Finform();


                 $this->render('reservations/modifier', ['changereserv' => $form->Create()]);

         }else{
          $_SESSION['flash']['erreur']= " Vous n'avez pas le droit de modifier cette reservation ";
         }
}
public function delete(int $id)
   {
         //on instancie le model;   
         $deletreserv = new  ReservationsModel;
         $reser_iduser = $deletreserv->findalljoin('users','users_id', 'id_users and id_reservations = '.$id);
         foreach ($reser_iduser as $Allreserv) {
    
          $user_id = $Allreserv['users_id'];
         
       };
       if (!empty($_SESSION['user']) && (($_SESSION['user']['id']== $user_id)||in_array('ROLE_ADMIN', $_SESSION['user']['roles'])))
       {

        $deletreserv->Delete($id);
        
       }
         // on recupere lannonce par son id;
          // on envoie a la vue ;
          // $this->render('reservations/delete',['reservedelate'=> $id]);
          header('location: http://the-bbq-restaurant/users/profil/'. $user_id);

  
    }
   public function annuler(int $id)
   {
       //on instancie le model;   
      $annulreserv = new  ReservationsModel;
      $datareserv = $annulreserv->find($id);
      $reserviduser = $annulreserv->findalljoin('users','users_id', 'id_users and id_reservations = '.$id);
 
 
      foreach ($reserviduser as $reserve) {
        
        $user_id = $reserve['users_id'];
        
         
     };
    
      if (!empty($_SESSION['user']) && (($_SESSION['user']['id']== $user_id)||in_array('ROLE_ADMIN', $_SESSION['user']['roles'])))
      {
       
        if ($datareserv ){
          $reservation =  $annulreserv->Hydrate( $datareserv);
          $reservation->setEtat(0);
          $annulreserv ->Update( $reservation,$id);
          }
      $this->render('reservations/annuler');

      }else{
        $_SESSION['flash']['erreur']= " Vous n'avez pas le droit de modifier cette reservation ";
       }
          
 
 
   }


    }

?>