<?php
    // include_once "config.ini.php"; Inclustion du fichier de config mais, je ne sais pas pour quelle raison ça marche pas en le faisant avec les variables
    function newConnect() {
        try {
            // creation d'un objet PDO pour pouvoir faire des requete vers la BD
            $conn = new PDO('mysql:host=mysql-colearnio.alwaysdata.net;dbname=colearnio_bdd','colearnio','ma3dnous');  // Repository github privé, les membres sont des membres de confiance
            
        } catch (PDOException $e) {
            echo 'Impossible de se connecter à la BDD : '.$e->getMessage();
            die();
        }

        return $conn;
    }



    

?>