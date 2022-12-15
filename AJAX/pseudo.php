<?php
    include_once __DIR__.'/../Model/connexionBD.php';
    $bdd = newConnect();
    if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        
    $query = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo =?');
    $query->execute(array($pseudo));
    $rows = $query->rowCount();
    if($rows==1){
        echo"notdispo";
    } else echo "dispo";

    $bdd = null;
    }

?>