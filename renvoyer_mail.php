


<?php

$titre = "Colearnio - Renvoi email";
include_once __DIR__ . '/View/header_index.php';

?>



<?php
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    include_once __DIR__.'/query/user.php';
    $userConfirm = getUserByEmail($email);

    if ($userConfirm->isValidMail) {
        echo '<div class="col-10 col-sm-6 container d-flex justify-content-center align-items-center monContainer flex-column shadow-lg p-3 mb-5 bg-body rounded my-auto mx-auto">
        <div class="mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#249109" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
    </div>
    <h3 class="text-center">Votre compte est déjà validé</h3>

</div>';
    } else {
        include_once __DIR__.'/Controller/sendMail.php';
    
        $key = password_hash($userConfirm->nom.date("Y-m-d H:i:s"),PASSWORD_DEFAULT);
        updateKey($email,$key);
        envoyerMail($email,$userConfirm->nom,$userConfirm->prenom,$key);
        echo '<div class="col-10 col-sm-6 container d-flex justify-content-center align-items-center monContainer flex-column shadow-lg p-3 mb-5 bg-body rounded my-auto mx-auto">
        <div class="mb-3">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#249109" class="bi bi-envelope-check-fill" viewBox="0 0 16 16">
  <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 4.697v4.974A4.491 4.491 0 0 0 12.5 8a4.49 4.49 0 0 0-1.965.45l-.338-.207L16 4.697Z"/>
  <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z"/>
</svg>
    </div>
    <h3 class="text-center">Email renvoyé</h3>
    <p class="text-center">Nous vous avons envoyé un email de confirmation. Vous devez confirmer votre compte dans les 15 minutes qui suivent votre inscription afin de pouvoir vous connecter</p>

</div>';
    }
    
} else {
    header("location:index.php");
}
?>









<?php
include_once __DIR__ . '/View/footer_index.php';
?>