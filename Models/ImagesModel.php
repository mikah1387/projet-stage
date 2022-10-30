<?php

namespace App\Models;



class ImagesModel extends Model
{

    protected $id_images;
    protected $name_image;
    protected $url_image;
    protected $annonces_id;
   
    
 public function __construct()
 {
    $this->table ='images' ;
    
 }

 




    /**
     * Get the value of id_images
     */ 
    public function getId_images()
    {
        return $this->id_images;
    }

    /**
     * Set the value of id_images
     *
     * @return  self
     */ 
    public function setId_images($id_images)
    {
        $this->id_images = $id_images;

        return $this;
    }

    /**
     * Get the value of name_image
     */ 
    public function getName_image()
    {
        return $this->name_image;
    }

    /**
     * Set the value of name_image
     *
     * @return  self
     */ 
    public function setName_image($name_image)
    {
        $this->name_image = $name_image;

        return $this;
    }

    /**
     * Get the value of url_image
     */ 
    public function getUrl_image()
    {
        return $this->url_image;
    }

    /**
     * Set the value of url_image
     *
     * @return  self
     */ 
    public function setUrl_image($url_image)
    {
        $this->url_image = $url_image;

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
}