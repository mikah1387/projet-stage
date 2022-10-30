<?php 

namespace App\Core;

class Form 
{

    public $formcode ='';

    /**
     * genere les formulaires htmls
     *
     * @return void
     */ 
     public function Create()
     {

         return $this->formcode;
     }
    /**
     * validation des champs : si ils sont remplies;
     * @param array $form tableau de formulaire ($_POST,$_GET);
     * @param array $champs tableau listant les champs;
     * 
     */
      
    public static function Validate(array $form,array $champs )
     {  
            
                 
                  if(($form)){

                  foreach($champs as $champ){
                    // Si le champ est absent ou vide dans le formulaire
                     $champnonvide =trim($form[$champ]);
                    if(!isset($champnonvide) || empty($champnonvide)){
                        // On sort en retournant false
                  
                        return false;
                    }
                }
  
                return true;
            
              }
        
     }
     public function unseterror(){

        unset($_SESSION['erreur']);
     }

    /**
     *  function Addattributes
     *
     * @param array $attributes tab assoc ['class'=>]
     * @return string
     */
    private function AddAttribute(array $attributes): string
     {
            $str ='';
            // on liste les attribus courts
            $courts = [ 'required','checked','disabled','readonly','multiple','autofocus','novalidate','formnovalidate'];

            foreach ($attributes as $attribute => $value) {
                //si lattrubus est dans la liste $courts
                 if (in_array($attribute,$courts) && $value ===true){

                     $str .= "$attribute"; 
                 }else{
                   // on ajoute la valuer a l'attribus
                    $str .= " $attribute = \"$value\""; 

                 }

             }
            return $str;
    }

     // balise ouverture de formulaires.
    public function Debutform( string $method ='POST', string $action ='#', array $attributes = []):self
    
        {
           // on cree la balise form
          $this->formcode .= "<form action = '$action' method = '$method'";
            // on ajoute les attributs 
          $this->formcode .= ($attributes)? $this->AddAttribute($attributes) .'>':'>';

         return  $this ;

        }
    // balise de fermeture;
    public function Finform()
       {

        $this->formcode .= '</form>';
        return $this ;
      }
// ajout de label 
    public function Addlabel(string $for, string $text, $attributes =[]):self
      {
        $this->formcode .= "<div> <label for = '$for' ";
        $this->formcode .= ($attributes)? $this->AddAttribute($attributes) : " ";
        $this->formcode .= " >$text</label>";
        return $this;

      }

      public function Addinput(string $type, string $name, array $attributes = []):self
      {
          
            $this->formcode .= "<input type = '$type' name = '$name'";
            $this->formcode .= ($attributes)? $this->AddAttribute($attributes). '> </div>' : "></div> ";
           
          
          
          return $this;
      }
      public function Addtextarea( string $name, string $value='', array $attributes =[]): self
      {

        $this->formcode .= "<div><textarea name = '$name'";
        $this->formcode .= ($attributes)? $this->AddAttribute($attributes) : "";
        $this->formcode .= "> $value </textarea> </div>";
        return $this;

      }
      public function Addselect(string $name, array $options, array $attributes =[]):self

      {
        $this->formcode .= "<div><select name ='$name' ";
        $this->formcode .= ($attributes)? $this->AddAttribute($attributes). '>' : "> ";
        foreach ($options as $value => $text) {


        $this->formcode .= "<option value =\"$value\"> $text </option>";
        
       }

       $this->formcode .= "</select> </div>";

        return $this;
      }

      public function Addbutton (string $text, array $attributes=[]):self
      {

        $this->formcode .= "<button ";
        $this->formcode .= ($attributes)? $this->AddAttribute($attributes). '>' : "> ";
        $this->formcode .= " $text </button>";
           
        return $this;
      }

}



