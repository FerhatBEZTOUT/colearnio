<?php
   
   include_once "C:\wamp64\www\colearnio\config.ini.php";
    function newConnect() {
    $conn = NULL;
    GLOBAL $host,$dbname,$user,$password;
   
        try {
           
            // creation d'un objet PDO pour pouvoir faire des requete vers la BD
            $conn = new PDO('mysql:host='. $host.';dbname='.$dbname.'',$user,$password);
            echo 'connexion réussie';
        } catch (PDOException $e) {
            echo 'Impossible de se connecter à la BDD : '.$e->getMessage();
           
        }

        return $conn;
    }
    
    function closeConn(){
        return NULL;
    }

    

?>