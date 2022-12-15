<?php
    if(!session_id()){
        session_start();
    }

    include_once __DIR__.'/../Model/connexionBD.php';
    include __DIR__.'/../query/cours.php';
    include  __DIR__.'/../affichPartenaire.php';

    $conn = newConnect(); 

    if(!empty($_POST["cours"]) && !empty($_POST["niveau"]) && !empty($_POST["ville"])){
    //echo "hey";
    // var_dump($_POST["cours"]);
        //$idCours = getCoursByIntiltule($_POST["cours"]);
        $query = $conn->prepare('SELECT * FROM etreDispo, utilisateur, formation, cours WHERE etreDispo.idCours = cours.idCours AND etreDispo.idUser = utilisateur.idUser AND formation.idFormation = utilisateur.formation AND etreDispo.idCours = ? AND niveau = ? AND idVille = ?');
        $query->execute(array($_POST["cours"], $_POST["niveau"], $_POST["ville"])); //array($_POST["cours"], $_POST["niveau"], $_POST["ville"])
?>
    <div class="container"> 
            <div class="row">
                <?php while ($data=$query->fetch()){ 
                    affichPart($data['pseudo'],$data['nomFormation'],$data['Motivation'],$data['idUser']);
                } ?>
            </div>
        </div>
    <?php 
    
    } else {
        if(!empty($_POST["cours"]) && !empty($_POST["niveau"])){
            //$idCours = getCoursByIntiltule($_POST["cours"]);
            $query = $conn->prepare('SELECT * FROM etreDispo, utilisateur, formation, cours WHERE etreDispo.idCours = cours.idCours AND etreDispo.idUser = utilisateur.idUser AND formation.idFormation = utilisateur.formation AND etreDispo.idCours = ? AND niveau = ?');
            $query->execute(array($_POST["cours"], $_POST["niveau"])); ?>
            <div class="container"> 
                <div class="row">
                    <?php while ($data=$query->fetch()){ 
                        affichPart($data['pseudo'],$data['nomFormation'],$data['Motivation'],$data['idUser']);
                    } ?>
                </div>
            </div>
        <?php } else {
            if(!empty($_POST["cours"])){
                // $idCours = getCoursByIntiltule($_POST["cours"]);
                $query = $conn->prepare('SELECT * FROM etreDispo, utilisateur, formation, cours WHERE etreDispo.idCours = cours.idCours AND etreDispo.idUser = utilisateur.idUser AND formation.idFormation = utilisateur.formation AND etreDispo.idCours = ?');
                $query->execute(array($_POST["cours"]));?>
                <div class="container"> 
                    <div class="row">
                        <?php while ($data=$query->fetch()){ 
                            affichPart($data['pseudo'],$data['nomFormation'],$data['Motivation'],$data['idUser']);
                        } ?>
                    </div>
                </div>
            <?php }
        }
    }


?>
