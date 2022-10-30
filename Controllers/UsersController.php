<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\ReservationsModel;
use App\Models\UsersModel;
use App\Models\CommentsModel;

use DateTime;

class UsersController extends Controller
{

    protected function tokken($length)
    {

        $alphabet = "123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
    //****methode login  */
    public function login()

    {
        $form = new Form;
        // $erreur ='';
        //   unset($_SESSION['erreur']);
        // on vérifier les entree email et pass
        if (Form::Validate($_POST, ['email', 'pass'])) {
            // on a des entree, on va recuperer l'email et pass l'utilisateur pour comparer
            $email = strip_tags($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['erreur'] = "email n'est pas  bon";
                header('location: login');

                die();
            }
            $userModel = new UsersModel;
            $userArray = $userModel->Findonebyemail($email);

            if ($userArray) {
                // var_dump($userArray);

                $passdb = $userArray['pass'];
                // var_dump($passdb);

                // var_dump($userArray);
                if (password_verify($_POST['pass'], $passdb)) {
                    var_dump($_POST);
                    $user = $userModel->Hydrate($userArray);
                    // var_dump($user);
                    // die;
                    $user->setSession();
                    // var_dump($_SESSION['user']);
                    $id = $_SESSION['user']['id'];
                    $_SESSION['flash']['success'] = 'vous étes bien connecté(e)';
                    header('location: profil/' . $id);
                    die;
                    // $this->profil($id);


                } else {
                    

                    $_SESSION['flash']['erreur'] = "Email ou mot de passe  incorrect";
                }
            } else {

                $_SESSION['flash']['erreur'] = "Email ou mot de passe  incorrect";
            }
        } else {
            if (!empty($_POST)) {


                $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
            }
        }


        $form->Debutform('POST', '', ['class' => 'form'])

            ->Addlabel('email', 'Email * :')
            ->Addinput('text', 'email')
            ->Addlabel('pass', 'Password *:')
            ->Addinput('password', 'pass')

            ->Addbutton('Connecter', ['type' => 'submit', 'class' => 'btn'])
            ->Finform();

        $this->render('users/login', ['loginform' => $form->Create()]);
    }
    //****methode register pour sinscrire  */
    public function PostImage(string $nameimage)
    {

        if (!empty($_FILES[$nameimage])) {





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

                        $url_image = '/uploadimages/imageprofils/'. $name;
                      
                        if (move_uploaded_file($tmp, 'C:/wamp64/www/Annonces_fr/Public' . $url_image)) {

                            $_SESSION['image']['success'] =  "l'image telechargée";
                        } else {

                            $_SESSION['image']['erreur'] = " image non telecharger";
                        }
                    } else {

                        $_SESSION['image']['erreur'] = " image de grande taille or error = 1";
                    }
                } else {

                    $_SESSION['image']['erreur'] = " double extension ou type no present";
                }
            } else {

                $_SESSION['image']['erreur'] =  "image non telecharger";
            }
        }
        $_POST[$nameimage] = isset($url_image) ? $url_image : null;
        

        return   $_POST[$nameimage];
    }
    public function register()

    {

        $form = new Form;


        if (Form::Validate($_POST, ['firstname', 'lastname', 'email', 'pass'])) {
            $firstname = strip_tags($_POST['firstname']);
            $lastname = strip_tags($_POST['lastname']);

            $email = strip_tags($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['erreur'] = "email n'est pas  bon";
                header('location: register');

                die();
            }

            $user = new UsersModel;
            $userArray = $user->Findonebyemail($email);

            if (($userArray) && $userArray['email'] == $email) {

                $_SESSION['flash']['erreur'] = "cet email existe déjas ";
            } else {
                $pass = password_hash($_POST['pass'], PASSWORD_ARGON2I);
                $_POST['imageprofil'] = $this->PostImage('imageprofil');

                $postuser = $user->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setEmail($email)
                    ->setPass($pass)
                    ->setRoles('["ROLE_USER"]')
                    ->setImageprofil($_POST['imageprofil']);
                      
                if($user->Create($postuser)) {
                    $_SESSION['flash']['success'] = " Bravo votre compte est bien créé ";
                    header('location: login');
                }else{
                    $_SESSION['flash']['erreur'] = "Le compte n'est créé!! ";
                }
                
            }
        } else {

            if ($_POST) {
                $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
            }
        }


        $form->Debutform('POST', '', ['class' => 'form', 'enctype' => "multipart/form-data"])
            ->Addlabel('firstname', 'Prenom * ')
            ->Addinput('text', 'firstname',['placeholder'=>''])
            ->Addlabel('lastname', 'Nom *')
            ->Addinput('text', 'lastname')
            ->Addlabel('email', 'Email * ')
            ->Addinput('email', 'email')
            ->Addlabel('pass', 'Password *')
            ->Addinput('password', 'pass')
            ->Addlabel('imageprofil', 'Ajouter une image de profil')
            ->Addinput('file', 'imageprofil')


            ->Addbutton('S\'inscrire', ['type' => 'submit', 'class' => 'btn'])
            ->Finform();


        $this->render('users/register', ['registerform' => $form->Create()]);
    }

    public function compte()
    {
        $this->render('users/compte');
    }

    //****methode logout pour deconnecter */

    public function logout()
    {
        unset($_SESSION['user']);
        header('location: http://the-bbq-restaurant');
        die;
        $this->render('main/index');
    }
    //****methode profil pour connecter a son profil  */

    public function profil($id)
    {
        if ((isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) && $_SESSION['user']['id'] == $id) {

            $form = new Form;
            $user = new UsersModel;
          //******Modification de profil  */
        if (Form::Validate($_POST, ['firstname', 'lastname', 'email', 'pass'])) {
            $firstname = strip_tags($_POST['firstname']);
            $lastname = strip_tags($_POST['lastname']);

            $email = strip_tags($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['erreur'] = "email n'est pas  bon";
                header('location: register');

                die();
            }

            $pass = password_hash($_POST['pass'], PASSWORD_ARGON2I);
            $_POST['imageprofil'] = $this->PostImage('imageprofil');
          

            $postuser = $user->setFirstname($firstname)
                ->setLastname($lastname)
                ->setEmail($email)
                ->setPass($pass)
                ->setImageprofil($_POST['imageprofil']);
            $user->Update($postuser, $id);
            $_SESSION['flash']['success'] = " Bravo votre compte est bien modifié ";
        } else {

            if ($_POST) {
                $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
            }
        }



        $form->Debutform('POST', '', ['class' => 'form', 'enctype' => "multipart/form-data"])
            ->Addlabel('firstname', 'Prenom ')
            ->Addinput('text', 'firstname')
            ->Addlabel('lastname', 'Nom ')
            ->Addinput('text', 'lastname')
            ->Addlabel('email', 'Email ')
            ->Addinput('email', 'email')
            ->Addlabel('pass', 'Password ')
            ->Addinput('password', 'pass')
            ->Addlabel('imageprofil', 'Modifier l\'image de profil')
            ->Addinput('file', 'imageprofil')
            ->Addbutton('Modifier', ['type' => 'submit', 'class' => 'btn'])
            ->Finform();


        


            // *********************
            $userModel = new UsersModel;
            // recuperation des donées utilisateur
            $userArray = $userModel->find($id);
            // recuperation des reservation de l' utilisateur

            $reserv = new ReservationsModel;
            $Allreservs = $reserv->findby(['users_id' => $id]);
            //recupération des commentaire avec jointure des menus 
            $commentModel = new CommentsModel;
            // $Allcomments = $commentModel->findby(['users_id' => $id]);
            $Allcomments = $commentModel->findalljoin('annonces','annonces_id','id_annonces where comments.users_id ='.$id);

           
            $this->render('users/profil', ['user' => $userArray, 'Allreservs' => $Allreservs, 'Allcomments' => $Allcomments,'modifierprofil' => $form->Create()]);
        } else {

            echo " page n'existe pas";
        }
    }

    //****methode modifier pour  modifier  son profil  */

    public function modifier($id)
    {
        $form = new Form;

        if (Form::Validate($_POST, ['firstname', 'lastname', 'email', 'pass'])) {
            $firstname = strip_tags($_POST['firstname']);
            $lastname = strip_tags($_POST['lastname']);

            $email = strip_tags($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['erreur'] = "email n'est pas  bon";
                header('location: register');

                die();
            }

            $pass = password_hash($_POST['pass'], PASSWORD_ARGON2I);
            $_POST['imageprofil'] = $this->PostImage('imageprofil');
            $user = new UsersModel;

            $postuser = $user->setFirstname($firstname)
                ->setLastname($lastname)
                ->setEmail($email)
                ->setPass($pass)
                ->setImageprofil($_POST['imageprofil']);
            $user->Update($postuser, $id);
            $_SESSION['flash']['success'] = " Bravo votre compte est bien modifié ";
          
        } else {

            if ($_POST) {
                $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
            }
        }



        $form->Debutform('POST', '', ['class' => 'form', 'enctype' => "multipart/form-data"])
            ->Addlabel('firstname', 'Prenom ')
            ->Addinput('text', 'firstname')
            ->Addlabel('lastname', 'Nom ')
            ->Addinput('text', 'lastname')
            ->Addlabel('email', 'Email ')
            ->Addinput('email', 'email')
            ->Addlabel('pass', 'Password ')
            ->Addinput('password', 'pass')
            ->Addlabel('imageprofil', 'Modifier l\'image de profil')
            ->Addinput('file', 'imageprofil')
            ->Addbutton('Modifier', ['type' => 'submit', 'class' => 'btn'])
            ->Finform();


        $this->render('users/modifier', ['modifierform' => $form->Create()]);
    }

    //****methode delete pour suprimer un compte  */

    public function delete(int $id)
    {
        //on instancie le model;   
        $deleteuser = new UsersModel;

        // on recupere lannonce par son id;
        $deleteuser->Delete($id);
        // on envoie a la vue ;
        $this->render('users/delete');

        // $this->render('annonces/');



    }
    public function forgot()
    {
        //on instancie le model;   

        $form = new Form;

        if (Form::Validate($_POST, ['email'])) {


            $email = strip_tags($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['erreur'] = "email n'est pas  bon";
                header('location: forgot');

                die();
            }
            $userModel = new UsersModel;
            $userArray = $userModel->Findonebyemail($email);

            if ($userArray) {


                $modeluser = $userModel->Hydrate($userArray);

                $id_user = $userArray['id_users'];
                $tokken_reset = $this->tokken(60);
                $headers = 'From: achache.hakim@gmail.com';


                $modeluser = $userModel->setTokken_reset($tokken_reset)
                    ->setReset_at(date("Y-m-d H:i:s"));


                $userModel->Update($modeluser, $id_user);



                mail($email, 'Rénitialisation de votre mot de passe', "pour modifier votre mot de passe cliquez sur ce lien\n\nhttp://the-bbq-restaurant/users/reset/$id_user/$tokken_reset", $headers);
                $_SESSION['flash']['success'] = " un mail de reinitialisation vous a été envoyer, verifiez votre boite mail! ";

                header('location: login');
                exit();
            }
        } else {

            if ($_POST) {
                $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
            }
        }

        $form->Debutform('POST', '', ['class' => 'form'])
            ->Addlabel('email', 'Email * ')
            ->Addinput('email', 'email')
            ->Addbutton('Envoyer ', ['type' => 'submit', 'class' => 'btn btn_annonces'])
            ->Finform();
        $this->render('users/forgot', ['forgotform' => $form->Create()]);
    }

    public function reset($id, $tokken)
    {
        $form = new Form;

        $userModel = new UsersModel;
        $datasuser = $userModel->find($id);
        $date1 = new DateTime("now");

        $date2 = new DateTime($datasuser['reset_at']);
        $interval = $date1->diff($date2);
        $time = 30;
        $minute = intval($interval->format(' %h')) * 60 + intval($interval->format(' %i'));
        if ($minute < $time) {
            if (Form::Validate($_POST, ['pass', 'confirm_pass'])) {
                $password = strip_tags($_POST['pass']);
                $confirm_password = strip_tags($_POST['confirm_pass']);

                if ($password === $confirm_password) {
                    $passwordhach = password_hash($_POST['pass'], PASSWORD_ARGON2I);
                    $modeluser = $userModel->Hydrate($datasuser);

                    $modeluser = $userModel->setPass($passwordhach)
                        ->setTokken_reset(null)

                        ->setReset_at(null);


                    $userModel->Update($modeluser, $id);
                    $userModel->setSession();

                    // var_dump($_SESSION['user']);
                    $id = $_SESSION['user']['id'];
                    $_SESSION['flash']['success'] = 'votre mot de passe est bien modifier';
                    header('location: /users/profil/' . $id);
                    die;
                }
            } else {
                if (($_POST)) {
                    $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
                }
            }


            $form->Debutform('POST', '', ['class' => 'form'])

                ->Addlabel('pass', 'Mot de passe :')
                ->Addinput('password', 'pass')
                ->Addlabel('confirm_pass', 'confirmation de mot de passe :')
                ->Addinput('password', 'confirm_pass')

                ->Addbutton('Réinitialiser', ['type' => 'submit', 'class' => 'btn'])
                ->Finform();
            $this->render('users/reset', ['resetpassform' => $form->Create()]);
        } else {

            $_SESSION['flash']['erreur'] = ' le lien n\'est pas bon ';
            header('location: http://the-bbq-restaurant/users/forgot');
            exit;
        }
















        // $this->render('annonces/');



    }
}
