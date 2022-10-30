<?php

namespace App\Models;



class UsersModel extends Model
{

    protected $id_users;
    protected $firstname;
    protected $lastname;
    protected $email ;
     protected $pass;
     protected $imageprofil;
     protected $tokken_reset;
     protected $reset_at;
     protected $roles;
    
 public function __construct()
 {
    $this->table ='users' ;
    
 }
// creer une session utilisateur
  public function setSession()
  {
     $_SESSION['user'] = [ 'id'=>$this->id_users,
                            'firstname'=> $this->firstname,
                            'lastname'=> $this->lastname,
                        'email'=>$this->email,
                          'roles'=>$this->roles];
  }
 // recuperer un user a partir de son email 


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function Findonebyemail(string $email)
    {
   
      return  $this->Requette('SELECT * FROM '. $this->table. ' WHERE email = ?',[$email] )->fetch();
    }
   
    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

 

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

     /**
      * Get the value of pass
      */ 
     public function getPass()
     {
          return $this->pass;
     }

     /**
      * Set the value of pass
      *
      * @return  self
      */ 
     public function setPass($pass)
     {
          $this->pass = $pass;

          return $this;
     }

     /**
      * Get the value of roles
      */ 
     public function getRoles():array
     {
          $roles= $this->roles;
          $roles[]="ROLE_USER";
          return array_unique($roles) ;
        //   return array_unique(json_decode($roles)) ;
     }

     /**
      * Set the value of roles
      *
      * @return  self
      */ 
     public function setRoles( $roles)
     {
          $this->roles =json_decode($roles) ;

          return $this;
     }

    /**
     * Get the value of id_users
     */ 
    public function getId_users()
    {
        return $this->id_users;
    }

    /**
     * Set the value of id_users
     *
     * @return  self
     */ 
    public function setId_users($id_users)
    {
        $this->id_users = $id_users;

        return $this;
    }

     /**
      * Get the value of tokken_reset
      */ 
     public function getTokken_reset()
     {
          return $this->tokken_reset;
     }

     /**
      * Set the value of tokken_reset
      *
      * @return  self
      */ 
     public function setTokken_reset($tokken_reset)
     {
          $this->tokken_reset = $tokken_reset;

          return $this;
     }

     /**
      * Get the value of reset_at
      */ 
     public function getReset_at()
     {
          return $this->reset_at;
     }

     /**
      * Set the value of reset_at
      *
      * @return  self
      */ 
     public function setReset_at($reset_at)
     {
          $this->reset_at = $reset_at;

          return $this;
     }

     /**
      * Get the value of imageprofil
      */ 
     public function getImageprofil()
     {
          return $this->imageprofil;
     }

     /**
      * Set the value of imageprofil
      *
      * @return  self
      */ 
     public function setImageprofil($imageprofil)
     {
          $this->imageprofil = $imageprofil;

          return $this;
     }
}