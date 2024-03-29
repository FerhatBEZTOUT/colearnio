<?php
if (!session_id()) {
  session_start();
}

if (isset($_SESSION['connecté'])) {
  header('location:index.php');
}

if (isset($_POST['envoi'])) {
  if (empty($_POST['nom'])) {
    echo 'empty nom';
  }
}


$titre = "Colearnio - Inscription";
include_once __DIR__ . '/View/header_index.php';

?>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="container d-flex justify-content-center align-items-center">

  <form method="POST" action="" class="form-inscr p-3 my-3" id="formInscr">

    <h2 class="text-center" style="color:#0d6efd;">Inscription</h2>
    <div class="text-center">
      <p class="error invisible" id="error"></p>
    </div>
    <div class="form-row">

      <div class="row ">
        <div class="form-group col-md-6 mt-2">
          <label for="inputNom">Nom</label>
          <input type="text" class="form-control" id="nom" name="nom" autocomplete="off" placeholder="Nom">
          <span id="error-nom" class=" error-span d-none"></span>
        </div>
        <div class="form-group col-md-6 mt-2">
          <label for="inputPrenom">Prénom</label>
          <input type="text" class="form-control" id="prenom" name="prenom" autocomplete="off" placeholder="Prénom">
          <span id="error-prenom" class=" error-span d-none"></span>
        </div>
      </div>


      <div class="form-group mt-2">
        <label for="inputNom">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" autocomplete="off" placeholder="Pseudo">
        <span id="error-pseudo" class=" error-span d-none"></span>
        <div id="feedbackdispo" class="invisible">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#26c40e" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
          </svg>
          <span class="">Pseudo disponible</span>
        </div>

        <div id="feedbacknodispo" class="invisible">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f21905" class=" bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
          </svg>
          <span class="">
            Pseudo non disponible</span>
        </div>


      </div>

      <div class="form-group col-md-12 mt-2">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="joedoe@gmail.com">
        <span id="error-email" class=" error-span d-none"></span>
      </div>

      <div class="row">
        <div class="col-sm-6 col-md-6 mt-2">
          <label for="inputPassword4">Mot de passe</label>
          <input type="password" class="form-control inputPassword4" id="mdp" name="mdp" autocomplete="off" placeholder="Mot de passe">
          <span id="error-mdp" class=" error-span d-none"></span>
        </div>
        <div class="col-sm-6 col-md-6 mt-2">
          <label for="inputPassword4">Confirmation</label>
          <input type="password" class="form-control inputPassword4" id="confmdp" name="confmdp" autocomplete="off" placeholder="Confirmer mot de passe">
          <span id="error-confmdp" class=" error-span d-none"></span>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary my-2" name="envoi" id="envoi">S'inscrire</button>
      
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif?20170503175831" class="load-img img-responsive invisible" />
      
    </div>
    <script type="text/javascript">
      var onloadCallback = function() {
        console.log("grecaptcha is ready!");
      };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
    </script>
    <div class="d-flex justify-content-center">
      <div class="g-recaptcha text-center" data-sitekey="6LdlCgkjAAAAABxZ5Gvk_ogblkTkGjyAPUci6qof" name="g-recaptcha-response"></div>
    </div>

  </form>

</div>


<script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script src="script/func.js"></script>
<script src="script/inscr.js"></script>

<?php

include_once __DIR__ . "/View/footer_index.php";
?>