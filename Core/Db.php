<?php 

namespace App\Core;
use PDO;
use PDOException;

class Db extends PDO
{
   
// instance unique de la class 
 private static $instance;

 private const DBHOST = 'localhost';
 private const DBUSER = 'root';
 private const DBPASS = '';
 private const DBNAME = 'pdo_poo';

 public function __construct()
 {
     
    $dsn ='mysql:dbname='.self::DBNAME. ';host='. self::DBHOST;

    try{
        parent :: __construct($dsn,self::DBUSER,self::DBPASS);
       $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'set NAMES utf8');
       $this-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
       $this-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){

          die($e->getMessage());
    }
 }

 public static function getInstance()
 {
         
    if(self::$instance===null){

        self::$instance = new Db(); 
    }
    return self::$instance;

 }


  
 

}