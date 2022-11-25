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

// function getFormationById($id){
//     try {
//         $conn = newConnect();
//         $query = $conn->prepare("SELECT nomFormation FROM formation, suivre WHERE formation.idFormation = suivre.idFormation AND idUser=?");
//         $query->execute(array($id));
//         $r = $query->fetchAll();
//         return $r; // $r = resultat fetch_obj c mieux quand même , regarde le résultat avec tu verras
//     } catch (PDOException $e) {
//        echo $e->getMessage();
//     }
// }

?>