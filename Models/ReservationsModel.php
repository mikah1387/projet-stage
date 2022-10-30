<?php

namespace App\Models;



class ReservationsModel extends Model
{

    protected $id_reservations;
    protected $nombres;
    protected $demande;
    protected $date_creation;
    protected $date_reservation ;
    protected $heure;
    protected $etat;
    protected $users_id;
    
 public function __construct()
 {
    $this->table ='reservations' ;
    
 }


 public function setSession()
 {
    $_SESSION['reservation'] = [ 'id'=>$this->id_reservations,
                                 'nombres'=>$this->nombres,
                                 'demande'=>$this->demande,
                                 'date_reservation'=> $this->date_reservation,
                                 'heure'=> $this->heure
                                 ];
 }
  

    /**
     * Get the value of nombres
     */ 
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set the value of nombres
     *
     * @return  self
     */ 
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get the value of demande
     */ 
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * Set the value of demande
     *
     * @return  self
     */ 
    public function setDemande($demande)
    {
        $this->demande = $demande;

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
     * Get the value of date_reservation
     */ 
    public function getDate_reservation()
    {
        return $this->date_reservation;
    }

    /**
     * Set the value of date_reservation
     *
     * @return  self
     */ 
    public function setDate_reservation($date_reservation)
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    /**
     * Get the value of heure
     */ 
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set the value of heure
     *
     * @return  self
     */ 
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get the value of etat
     */ 
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @return  self
     */ 
    public function setEtat($etat)
    {
        $this->etat = $etat;

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
     * Get the value of id_reservations
     */ 
    public function getId_reservations()
    {
        return $this->id_reservations;
    }

    /**
     * Set the value of id_reservations
     *
     * @return  self
     */ 
    public function setId_reservations($id_reservations)
    {
        $this->id_reservations = $id_reservations;

        return $this;
    }
}