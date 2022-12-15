<?php
    include_once __DIR__.'/../Model/connexionBD.php';
    function getCoursByIntiltule($intitule){
        try {
            $conn = newConnect();
            $query = $conn->prepare("SELECT idCours FROM cours WHERE intitule = ?");
            $query->execute(array($intitule));
            $r = $query->fetch();;
            return $r; 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>