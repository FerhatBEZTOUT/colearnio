<?php
if(!session_id()){
  session_start();
}

if(isset($_SESSION['connecté'])) {
  header('location:index.php');
}

include_once 'Model/connexionBD.php';



if (isset($_POST['envoi'])) {
  if (!empty($_POST['jour']) && !empty($_POST['mois']) && !empty($_POST['annee'])) {
    $d = $_POST['annee'] . '-' . $_POST['mois'] . '-' . $_POST['jour'];
    $vdate = date('Y-m-d', strtotime($d));
    //var_dump($vdate);
  } else $vdate = null;
  if (!empty($_POST['rue'])) {
    $rue = htmlspecialchars($_POST['rue']);
  } else $rue = null;
  if (!empty($_POST['codePostal'])) {
    $codePostal = htmlspecialchars($_POST['codePostal']);
  } else $codePostal = null;
  if (
    !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['ville'])
    && !empty($_POST['niveau']) && !empty($_POST['mdps']) && !empty($_POST['email']) && !empty($_POST['confmdps'])
  ) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $ville = htmlspecialchars($_POST['ville']);
    $niveau = htmlspecialchars($_POST['niveau']);
    $email = htmlspecialchars($_POST['email']);
    $mdps = htmlspecialchars($_POST['mdps']);
    $confmdps = htmlspecialchars($_POST['confmdps']);

    $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE email =?');
    $recupUser->execute(array($email));
    $tabusers = $recupUser->fetchAll();
    //$insertUser = $bdd->query('INSERT INTO user VALUES(null,"dass","dass","'.$vdate.'",null,"1234","aa","m1","dass36@gmail.com","dddddd")');

    if (count($tabusers) == 0) {
      if ((strlen($mdps) >= 8) && (preg_match('/[A-Za-z][0-9]/', $mdps))) {
        if ($mdps === $confmdps) {
          $mdps = password_hash($_POST['mdps'], PASSWORD_DEFAULT);
          //echo "yes";
          $insertUser = $bdd->prepare('INSERT INTO utilisateur VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

          $currentTime = date('Y-m-d H:i:s', (time()));

          $key = password_hash($nom.$currentTime, PASSWORD_DEFAULT);

          $insertUser->execute(array(NULL,$nom,$prenom,$vdate,$pseudo,$rue,$codePostal,$ville,$email,$mdps,0,$key,NULL,$niveau,false,$currentTime));
          
          header('location:verification.php?email='.$email);
        }
      } else header('Location: inscription.php?error=Le mot de passe doit contenir une majuscule, une minuscule et un chiffre.');
    }
  } else header('Location: inscription.php?error= Les champs avec une * sont obligatoires');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Colearnio, apprendre ensemble</title>
</head>

<body>

  <div class="container d-flex justify-content-center my-2 ">
    <form method="POST" action="" class="form-inscr p-3">
      <h2 class="text-center" style="color:white;">Inscription</h2>
      <div class="form-row">
        <div class="row col-sm-6 col-md-12">
          <div class="col-sm-6 col-md-6">
            <label for="inputNom">Nom*</label>
            <input type="text" class="form-control" id="inputNom" name="nom" autocomplete="off" placeholder="Nom">
          </div>
          <div class="col-sm-6 col-md-6">
            <label for="inputPrenom">Prénom*</label>
            <input type="text" class="form-control" id="inputPrenom" name="prenom" autocomplete="off" placeholder="Prénom">
          </div>
        </div>
        <div class="form-group col-md-12">
          <label for="inputNom">Pseudo*</label>
          <input type="text" class="form-control" id="inputPseudo" name="pseudo" autocomplete="off" placeholder="Pseudo">
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
        <div class="row col-md-12">
          <label for="inputDateNaiss">Date de naissance</label>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <select class="form-select mt-1" name="jour" id="">
              <?php
              echo '<option value="">Jour</option>';
              for ($i = 1; $i < 32; $i++) {
                echo '<option value=' . $i . '>' . $i . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <select class="form-select mt-1" name="mois" id="">
              <?php
              echo '<option value="">Mois</option>';
              for ($i = 1; $i < 13; $i++) {
                echo '<option value=' . $i . '>' . $i . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <select class="form-select mt-1" name="annee" id="">
              <?php
              $year = date('Y');
              $y = $year - 18;
              $y2 = $year - 110;
              echo '<option value="">Annee</option>';
              for ($i = $y; $i > $y2; $i--) {
                echo '<option value=' . $i . '>' . $i . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group col-md-12">
          <label for="inputVille">Ville*</label>
          <input type="text" class="form-control" id="inputVille" name="ville" autocomplete="off" placeholder="Paris">
        </div>
        <div class="form-group col-md-12">
          <label for="inputRue">Rue</label>
          <input type="text" class="form-control" id="inputRue" name="rue" autocomplete="off" placeholder="81 Rue de Bercy">
        </div>
        <div class="form-group col-md-12">
          <label for="inputCodePotsal">Code Postal</label>
          <input type="text" class="form-control" id="inputCodePotsal" name="code" autocomplete="off" placeholder="75012">
        </div>
        <div class="form-group col-md-12">
          <label for="inputNiveau">Niveau*</label>
          <div class="col-xs-4 col-sm-4 col-md-4">
            <select class="form-select" name="niveau" id="">
              <?php
              echo '<option value="">Niveau</option>';
              echo '<option value="0">BAC</option>';
              for ($i = 1; $i < 6; $i++) {
                echo '<option value=' . $i . '>BAC+' . $i . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group col-md-12">
          <label for="inputEmail4">Email*</label>
          <input type="email" class="form-control" id="inputEmail4" name="email" autocomplete="off" placeholder="joedoe@gmail.com">
        </div>
        <div class="row col-md-12">
          <div class="col-sm-6 col-md-6">
            <label for="inputPassword4">Mot de passe*</label>
            <input type="password" class="form-control" class="inputPassword4" name="mdps" autocomplete="off" placeholder="Mot de passe">
          </div>
          <div class="col-sm-6 col-md-6">
            <label for="inputPassword4">Confirmation*</label>
            <input type="password" class="form-control" class="inputPassword4" name="confmdps" autocomplete="off" placeholder="Mot de passe">
          </div>
        </div>
      </div>
      <div class="text-center my-1 col-sm-6 col-md-12">
        <button type="submit" class="btn btn-primary my-2" name="envoi">S'inscrire</button>
      </div>
      <div class="text-center">

        <?php
        if (isset($_GET['error'])) {
          echo '<p class="error">' . $_GET['error'] . '</p>';
        }
        ?>
      </div>
    </form>

  </div>

  <script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
  <script src="script/func.js"></script>
</body>

</html>