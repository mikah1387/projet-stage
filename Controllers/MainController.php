<?php 

 namespace App\Controllers;
 use App\Models\UsersModel;
 use App\Models\NewsModel;
 use App\Core\Form;



 class MainController extends Controller

 {
       public function index()
       {
     
        
        $this->render('main/index');
      //   include_once ROOT.'/Views/main/index.php';
      
       }
       public function contact()
       {

            $form = new Form;


            if (Form::Validate($_POST, [ 'email'])) {
               
    
                $email = strip_tags($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['flash']['erreur'] = "email n'est pas  bon";
                    header('location: contact');
    
                    die();
                }
             
                $userlatter = new NewsModel; 
                $userArray = $userlatter->Findonebyemail($email);
                
                if (($userArray) && $userArray['email'] == $email) {
    
                    $_SESSION['flash']['erreur'] = "cet email existe déjas ";
                } else {
                  
    
                    $postuserlatter =$userlatter->setEmail($email);
                        
    
                    if($userlatter->Create($postuserlatter)) {
                        $_SESSION['flash']['success'] = " Bravo vous etes abbonné(e) a notre newslatter";
                      
                    }else{
                        $_SESSION['flash']['erreur'] = "vous n'etes  pas abonné(e)!! ";
                    }
                    
                }
              
              
              }  else{

                  if ($_POST) {
                        $_SESSION['flash']['erreur'] = "Le formulaire est incomplet!! ";
                    }
                }

              
        $form->Debutform('POST', '', ['class' => 'formnews'])

        ->Addlabel('email', '')
        ->Addinput('text', 'email',['placeholder'=> 'Votre Email'])

        ->Addbutton('Envoyer', ['type' => 'submit', 'class' => 'btn'])
        ->Finform();

        $this->render('main/contact', ['newslatter' => $form->Create()]);
 }

 } 