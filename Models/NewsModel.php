<?php

namespace App\Models;



class NewsModel extends Model
{

    protected $id_news;
    protected $email;
   
    
 public function __construct()
 {
    $this->table ='news' ;
    
 }

    /**
     * Get the value of id_news
     */ 
    public function getId_news()
    {
        return $this->id_news;
    }

    /**
     * Set the value of id_news
     *
     * @return  self
     */ 
    public function setId_news($id_news)
    {
        $this->id_news = $id_news;

        return $this;
    }

    /**
     * Get the value of emailnews
     */ 
   

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
}