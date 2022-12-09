<?php
    include_once __DIR__.'/../Model/connexionBD.php'; 

    function getFormationByUserId($id){
        try {
            $conn = newConnect();
            $query = $conn->prepare('SELECT nomFormation FROM formation, utilisateur WHERE formation.idFormation = utilisateur.formation AND idUser=?');
            $query->execute(array($id));
            $f = $query->fetch(PDO::FETCH_OBJ);
            return $f;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
?>