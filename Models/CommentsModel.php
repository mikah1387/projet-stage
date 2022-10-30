<?php

namespace App\Models;



class CommentsModel extends Model
{

    protected $id_comments;
    protected $titrecomment;
    protected $comment;
    protected $date_creation ;
    protected $actif;
    protected $users_id;
    protected $annonces_id;
    
 public function __construct()
 {
    $this->table ='comments' ;
    
 }

    /**
     * Get the value of id_comments
     */ 
    public function getId_comments()
    {
        return $this->id_comments;
    }

    /**
     * Set the value of id_comments
     *
     * @return  self
     */ 
    public function setId_comments($id_comments)
    {
        $this->id_comments = $id_comments;

        return $this;
    }

    /**
     * Get the value of date_creation
     */ 
    public function getDate_creation()
    {
        return $this->date_creation;
    }

    /**
     * Set the value of date_creation
     *
     * @return  self
     */ 
    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * Get the value of actif
     */ 
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set the value of actif
     *
     * @return  self
     */ 
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get the value of users_id
     */ 
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * Set the value of users_id
     *
     * @return  self
     */ 
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }

    /**
     * Get the value of annonces_id
     */ 
    public function getAnnonces_id()
    {
        return $this->annonces_id;
    }

    /**
     * Set the value of annonces_id
     *
     * @return  self
     */ 
    public function setAnnonces_id($annonces_id)
    {
        $this->annonces_id = $annonces_id;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

   
  

    /**
     * Get the value of titrecomment
     */ 
    public function getTitrecomment()
    {
        return $this->titrecomment;
    }

    /**
     * Set the value of titrecomment
     *
     * @return  self
     */ 
    public function setTitrecomment($titrecomment)
    {
        $this->titrecomment = $titrecomment;

        return $this;
    }
}