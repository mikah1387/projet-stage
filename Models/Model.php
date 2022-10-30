<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    protected $table ;
    private $db; 

    public function Requette (string $sql, array $attributs=null) 
    {
        // on recupere linstance Db;
        $this->db = Db::getInstance();
      

        //on verifier si on a des attributs;

        if ($attributs !== null){

          $reqt= $this->db->prepare($sql);
          $reqt->execute($attributs);
          return $reqt;
          
        }else{

             return $this->db->query($sql);
        }


    }
    // recuperer tout les donnees de db
    public function findall()
    {

        $tableall = $this->Requette('SELECT * FROM '. $this->table ) ;
        return $tableall->fetchAll();
    }
    public function findalljoin( string $table2, string $id1, string $id2)
   // select * from annonces join users on annonces.users_id = users.id_users;
    {

        $tableall = $this->Requette('SELECT * FROM '. $this->table.' join '.$table2.' on '. $this->table .'.'.$id1.' = '.$table2.'.'.$id2 ) ;
       
        return $tableall->fetchAll();
    }
    // recupere les donnees par selection id;
    public function find($id)
    {   
        return  $this->Requette('SELECT * FROM '. $this->table. ' WHERE id_'.$this->table. '=' .$id )->fetch();
        
    }
    // conter un champ 
    //SELECT COUNT('lik') as likess FROM likes WHERE comments_id=51 and lik=1;
    public function findcount($champ,$value,$champ2,$id)
    {

        return $this->Requette('SELECT COUNT('.$champ.') as likess FROM '.$this->table. ' WHERE '.$champ2. '='.$id .' and '.$champ.'='.$value)->fetch();
    }
   // recupere les donnees par selection email;
    public function Findonebyemail(string $email)
    {

            return  $this->Requette('SELECT * FROM '. $this->table. ' WHERE email = ?',[$email] )->fetch();
    }
    // recuperer des donnees par tableau assoc 
   public function findby(array $criters)
     {
            $champs=[];
             $values=[];
       foreach ($criters as $champ => $value) {
           
           

               $champs[] = " $champ =? ";
               $values[] =$value;
       }

       $condition=  implode("and", $champs);
     
       return $this->Requette('SELECT * FROM '. $this->table . ' WHERE '. $condition , $values )->fetchAll() ;
     
   }

   // inserer des donnes ;

   public function Create(Model $model)
{
   // insert into this table (titre, detail, date-creation, actif ) values (?,?,?,?)
   $champs=[];
   $values=[];
   $interogation=[];
     foreach ($model as $champ => $value) {
 
 
    if($value !== null  && $champ !='db' && $champ !== "table"){
   
        $champs[] = $champ ;
        $interogation[]= " ? ";
        
        if (is_array($value)){

            $value = json_encode($value);
        }
            $values[] =$value;
            
        
  }
    }
   
       

 $condition=  implode(",", $champs);
 $interogation=  implode(",", $interogation);
 // var_dump($condition);

 // var_dump($interogation);


  //  var_dump($condition);

  // return $this->Requette(' INSERT INTO '. $this->table . ' ( '. $condition .  ') '.' values  (?,?,?) ' , $values );
   return $this->Requette(" INSERT INTO  $this->table  ( $condition )  values  ( $interogation ) " , $values );



}
    public function Hydrate( $tabassoc)
    {

       foreach ($tabassoc as $key => $value) {
          
        
            $setter = 'set'. ucfirst($key);

         if (method_exists($this,$setter)){
            $this->$setter($value);
         }
            
       }
       return $this;

    }

    public function Update( model $model , int $id)

        {
            // update this table set titre=? , detail=?, actif = ? where id = ;
            $champs=[];
            $values=[];
            
         foreach ($model as $champ => $value) {
          
          
             if($value !== null  && $champ !='db' && $champ !== "table"){
            
                 $champs[] = "$champ =?" ;
                if (is_array($value)){

                    $value = json_encode($value);
                }
               $values[] =$value;
         }
             }
              
          $values[] = $id;
        
          $condition=  implode(",", $champs );
         
    
         
         
          return $this->Requette("UPDATE $this->table set  $condition where ".' id_'.$this->table. ' = ? '  ,  $values );

        }
      
         public function Delete(int $id)
         {
          //  DELETE from this table where id = 2;
             
            $sql = 'DELETE FROM '. $this->table. ' WHERE id_'.$this->table. ' = ? ';
           
              
              return  $this->Requette($sql, [$id ]);
            
         }

}