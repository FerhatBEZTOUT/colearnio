<?php

include_once __DIR__.'/../Model/connexionBD.php';

function getPartenaire(){
    try {
        $conn = newConnect();
        $query = $conn->prepare('SELECT * FROM etreDispo, utilisateur, formation, cours WHERE etreDispo.idCours = cours.idCours AND etreDispo.idUser = utilisateur.idUser AND formation.idFormation = utilisateur.formation');
        $query->execute();
        return $query; 
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getCours(){
    try {
        $conn = newConnect();
        $cours = "SELECT idCours, intitule FROM cours";
        $cours = $conn->prepare($cours);
        $cours->execute();
        return $cours; 
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getVille(){
    try {
        $conn = newConnect();
        $ville = $conn->prepare("SELECT idVille, nom_ville FROM ville");
        $ville->execute();
        return $ville; 
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>