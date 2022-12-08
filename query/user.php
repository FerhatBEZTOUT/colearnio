<?php

include_once __DIR__.'/../Model/connexionBD.php';


function getUserById($id){
    try {
        $conn = newConnect();
        $query = $conn->prepare("SELECT * FROM utilisateur WHERE idUser=?");
        $query->execute(array($id));
        $r = $query->fetch(PDO::FETCH_OBJ);
        return $r; // $r = resultat fetch_obj c mieux quand même , regarde le résultat avec tu verras
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



 function getUserByKey($cle) {
    
    
    try {
        $conn = newConnect();
        $query = $conn->prepare("SELECT * FROM utilisateur WHERE cle=?");
        $query->execute(array($cle));
        $resultat =  $query->fetch(PDO::FETCH_OBJ);
        return $resultat;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
   }

    function validateUser($cle) {
   
    $conn = newConnect();
    try {

        $query = $conn->prepare("UPDATE utilisateur SET isValidMail=? WHERE cle=?");
        $resultat = $query->execute(array(1,$cle));

        return $resultat;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
   }

    function getUserByEmail($email) {
    
    
    try {
        $conn = newConnect();
        $query = $conn->prepare("SELECT * FROM utilisateur WHERE email=?");
        $query->execute(array($email));
        $resultat = $query->fetch(PDO::FETCH_OBJ); 
        
        return $resultat;
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
   }
   
    function inscrire(string $nom,string $prenom,string $pseudo, string $email, string $mdp, string $cle) {
          
          $conn = newConnect();
          $q = $conn->prepare('INSERT INTO utilisateur(nom,prenom,pseudo,email,mdp,isValidMail,cle,dateTimeInscri)
          VALUES (?,?,?,?,?,?,?,?)');
          $r = $q->execute(array($nom,$prenom,$pseudo,$email,$mdp,0,$cle,date("Y-m-d H:i:s")));

          return $r;
   }

   
function getVilleByID($idVille) {
    try {
        $conn = newConnect();
        $query = $conn->prepare("SELECT nom_ville FROM ville WHERE id=?");
        $query->execute(array($idVille));
        $resultat = $query->fetch(PDO::FETCH_OBJ); 
        
        return $resultat;
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}