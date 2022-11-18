<?php
   
    include_once "C:\wamp\www\colearnio\config.ini.php";
    function newConnect() {
    $conn = NULL;
    GLOBAL $host,$dbname,$user,$password;
   
        try {
           
            // objet PDO qui permet de faire des requete vers la BD
            $conn = new PDO('mysql:host='. $host.';dbname='.$dbname.'',$user,$password);
           
        } catch (PDOException $e) {
            echo 'Impossible de se connecter à la BDD : '.$e->getMessage();
            
        }

        return $conn;
    }
    
    function closeConn(){
        return NULL;
    }

   

?>