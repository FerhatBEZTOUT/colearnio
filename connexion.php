<?php

$titre = "Colearnio - Connexion";
include_once __DIR__ . '/View/header_index.php';

?>
 <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<section>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card form-inscr">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="./img/login.svg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height:100%" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form id="connexionForm" method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    
                    <span class="h1 fw-bold mb-0">Connexion</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Se connecter à mon compte</h5>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" class="form-control form-control-lg" name="email" />
                    <label class="form-label" for="email">Email</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="mdp" class="form-control form-control-lg" name="mdp" />
                    <label class="form-label" for="mdp">Mot de passe</label>
                  </div>
                  <p id="error" class=" error invisible">Email ou mot de passe incorrect</p>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" id="seConnecter">Se connecter</button>
                  </div>

                  <a class="small text-muted" href="./inscription.php">Mot de passe oublié?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Vous n'avez pas de compte? <a href="./inscription.php" style="color: #393f81;">S'inscrire</a></p>
                  <a href="#!" class="small text-muted">Conditions d'utilisations.</a>
                  <a href="#!" class="small text-muted">Politique de confidentialité</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include_once __DIR__ . '/View/footer_index.php';
?>