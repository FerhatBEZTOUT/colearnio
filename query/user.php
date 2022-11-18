<?php

include_once 'connexionBD.php';
$conn = newConnect();

function getUserById($id){
    try {
        $query = $conn->prepare("SELECT * FROM utilisateur WHERE id=?");
        $query->execute(array($id));
        $r = $query->fetch(PDO::FETCH_OBJ); // $r = resultat
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>