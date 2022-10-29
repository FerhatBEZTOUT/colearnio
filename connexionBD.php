<?php
    include_once "config.ini.php";

    try {
        $bdd = new PDO('mysql:dbname='.$dbname.';host='.$host.'', $user, $password);
    } catch (PDOException $e) {
        echo 'Impossible de se connecter à la BDD : '.$e;
    }

    
?>