<?php


if ( isset($_GET['key'])) {
    $key = $_GET['key'];
    include_once 'Model/Utilisateur.class.php';
    // Création d'un objet utilisateur
    $u = new Utilisateur();

    // Récupération des infos via la clé de validation
    $u->getUserByKey($key);

    
    if ($u->getIsValidMail()) {
        echo '<h1>Votre compte est déjà valide</h1>';
        header( "refresh:5;url=connexion.php" );
    } 
    
    elseif (date('Y-m-d H:i:s', (time() - 60 * 15))<$u->getDateTimeInscri()) { 
        // temps courant - 15 min <= moment d'inscription
        $u->validateUser($key);
        echo '<h1>Votre compte a été validé</h1>';
        header( "refresh:5;url=connexion.php" );
     } 
     else {
        
        echo '<h1>lien expiré</h1>';
     }
}

?>