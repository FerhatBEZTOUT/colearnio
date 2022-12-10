<?php

$titre = "Colearnio - Confirmation d'inscription";
include_once __DIR__ . '/View/header_index.php';

?>


<div class="col-10 col-sm-6 container d-flex justify-content-center align-items-center monContainer flex-column shadow-lg p-3 mb-5 bg-body rounded my-auto mx-auto">
        <div class="mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#249109" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
    </div>
    <h3 class="text-center">Inscription réussie</h3>
    <p class="text-center">Nous vous avons envoyé un email de confirmation. Vous devez confirmer votre compte dans les 15 minutes qui suivent votre inscription afin de pouvoir vous connecter</p>
    <a class="mt-3 btn btn-primary" href="telechargerFiche.php" target="_blank" rel="noopener noreferrer" >Renvoyer l'email de confirmation</a>

</div>







<?php
include_once __DIR__ . '/View/footer_index.php';
?>