<?php

$titre = "Colearnio - Connexion";
include_once __DIR__ . '/View/header_index.php';

?>



<?php


if (isset($_GET['key'])) {
    $key = $_GET['key'];
    include_once __DIR__.'/query/user.php';
    // Création d'un objet utilisateur
    

    // Récupération des infos via la clé de validation
    $u = getUserByKey($key);
    
    
    if ($u->isValidMail) {
        echo '<div class="col-10 col-sm-6 container d-flex justify-content-center align-items-center monContainer flex-column shadow-lg p-3 mb-5 bg-body rounded my-auto mx-auto">
        <div class="mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#249109" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
    </div>
    <h3 class="text-center">Votre compte est déjà validé</h3>

</div>';
        header( "refresh:5;url=connexion.php" );
    } 
    
    elseif (date('Y-m-d H:i:s', (time() - 60 * 15))<$u->dateTimeInscri) { 
        // temps courant - 15 min <= moment d'inscription
        validateUser($key);
        echo '<div class="col-10 col-sm-6 container d-flex justify-content-center align-items-center monContainer flex-column shadow-lg p-3 mb-5 bg-body rounded my-auto mx-auto">
        <div class="mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#249109" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
    </div>
    <h3 class="text-center">Compte validé</h3>
    <p class="text-center">Félicitations, vous pouvez maintenant accéder à votre compte.</p>

</div>';
        header( "refresh:5;url=connexion.php" );
     } 
     else {
        
        echo '<div class="col-10 col-sm-6 container d-flex justify-content-center align-items-center monContainer flex-column shadow-lg p-3 mb-5 bg-body rounded my-auto mx-auto">
        <div class="mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#ff032d" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
    </div>
    <h3 class="text-center">Lien expiré</h3>
    <a href="renvoyer_mail.php?email='.$u->email.'">Renvoyer l\'émail de confirmation</a>
</div>';
     }
} else {
    //header("location:index.php");
}

?>






<?php
include_once __DIR__ . '/View/footer_index.php';
?>



