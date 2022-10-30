<?php

namespace App\Models;



class LikesModel extends Model
{

    protected $id_likes;
    protected $lik;
    protected $dislike;
    protected $comments_id ;
    protected $users_id;
    
    
 public function __construct()
 {
    $this->table ='likes' ;
    
 }

 

    /**
     * Get the value of id_likes
     */ 
    public function getId_likes()
    {
        return $this->id_likes;
    }

    /**
     * Set the value of id_likes
     *
     * @return  self
     */ 
    public function setId_likes($id_likes)
    {
        $this->id_likes = $id_likes;

        return $this;
    }

    /**
     * Get the value of lik
     */ 
    public function getLik()
    {
        return $this->lik;
    }

    /**
     * Set the value of lik
     *
     * @return  self
     */ 
    public function setLik($lik)
    {
        $this->lik = $lik;

        return $this;
    }

    /**
     * Get the value of dislike
     */ 
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Set the value of dislike
     *
     * @return  self
     */ 
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;

        return $this;
    }

    /**
     * Get the value of comments_id
     */ 
    public function getComments_id()
    {
        return $this->comments_id;
    }

    /**
     * Set the value of comments_id
     *
     * @return  self
     */ 
    public function setComments_id($comments_id)
    {
        $this->comments_id = $comments_id;

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
}