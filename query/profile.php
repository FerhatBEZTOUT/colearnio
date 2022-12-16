<?php

include_once __DIR__.'/../Model/connexionBD.php';

function updateUser($nom,$prenom,$description,$rue,$codePost,$ville,$tel,$dateNaiss,$niveau,$id){
    try {
        $conn = newConnect();
        $modifUser = $conn->prepare('UPDATE utilisateur set 
        nom="' . $nom. '", 
        prenom="' . $prenom. '", 
        descripUser="' .$description. '", 
        rue="'.$rue.'", 
        codePost="'.$codePost.'", 
        ville="'.$ville.'", 
        telephone="' .$tel. '", 
        dateNaiss="' .$dateNaiss. '",
        niveau="' . $niveau. '" 
        WHERE idUser=?');
        $modifUser->execute(array($id));
        $modifUser = $modifUser->fetch(PDO::FETCH_OBJ);
        return $modifUser; 
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

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