<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use App\Core\Form;
use App\Models\UsersModel;
use App\Models\CommentsModel;
use App\Core\Db;

class CommentsController extends Controller
{

  public function commenter($id)
  {


    $annoncesmodel = new AnnoncesModel;
    $addcomment =  new CommentsModel;
    $form = new Form;

    if (!empty($_SESSION['user'])) {

      if (Form::Validate($_POST, ['titrecomment', 'comment'])) {

        $titre = strip_tags($_POST['titrecomment']);


        $comment = strip_tags($_POST['comment']);


        $postcomment =  $addcomment->setTitrecomment($titre)
          ->setComment($comment)
          ->setDate_creation(date("Y-m-d H:i:s"))
          ->setActif(1)
          ->setUsers_id($_SESSION['user']['id'])
          ->setAnnonces_id($id);

        if ($addcomment->Create($postcomment)) {

          $_SESSION['flash']['success'] = " Bravo votre commentaire est bien ajouté ";
          header('location: /annonces/lire/' . $id);
        } else {
          $_SESSION['flash']['erreur'] = "le commentaire n\'est ajouté!!";
        }
      } else {

        if ($_POST) {
          $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
        }
      }

      $form->Debutform('POST', '', ['class' => 'form'])
        ->Addlabel('titre', 'Titre *')
        ->Addinput('text', 'titrecomment')
        ->Addlabel('comment', 'Commentaire *')
        ->Addtextarea('comment', 'ajouter un commentaire')
        ->Addbutton('Ajouter', ['type' => 'submit', 'class' => 'btn'])
        ->Finform();
      $this->render('comments/commenter', ['commentform' => $form->Create()]);
    } else {
      $_SESSION['flash']['erreur'] = 'vous devez  connecter pour commenter';
      // $this->render('reservations/reserver');

    }
  }

  public function delete(int $id)
  {
    //on instancie le model;   
    $deletecomment = new CommentsModel;
    $comment_iduser =  $deletecomment->findalljoin('users', 'users_id', 'id_users and id_comments = ' . $id);
    foreach ($comment_iduser as $comment) {

      $user_id = $comment['users_id'];
    };

    if (!empty($_SESSION['user']) && (($_SESSION['user']['id'] == $user_id) || in_array('ROLE_ADMIN', $_SESSION['user']['roles']))) {
      $deletecomment->Delete($id);
      $_SESSION['flash']['success'] = " votre avis est bien supprimer ";
    } else {
      $_SESSION['flash']['erreur'] = " votre n'avez pas le droit !!! ";
    }
    // on recupere lannonce par son id;

    // on envoie a la vue ;
    // $this->render('users/profil');


  }
}
