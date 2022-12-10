<?php
if (!session_id()) {
    session_start();
}
//traiter date de naissance et image

// __DIR__ c'est pour le site Alwaysdata , 
/// ne pas mettre __DIR__ cause des erreurs, il arrive pas à trouver le chemin relatif
include_once __DIR__ . '/Model/connexionBD.php';
include __DIR__ . '/query/user.php';

$conn = newConnect();

//var_dump($user);
$idUser = $_SESSION['user']->idUser;
$idFormation = $_SESSION['user']->formation;


if (isset($_POST['submit'])) {
    // echo "yes";
    $modifUser = $conn->prepare('UPDATE utilisateur set 
    nom="' . $_POST['nom'] . '", 
    prenom="' . $_POST['prenom'] . '", 
    descripUser="' . $_POST['description'] . '", 
    rue="' . $_POST['rue'] . '", 
    codePost="' . $_POST['codePost'] . '", 
    ville="' . $_POST['ville'] . '", 
    telephone="' . $_POST['tel'] . '", 
    dateNaiss="' . $_POST['dateNaiss'] . '",
    niveau="' . $_POST['niveau'] . '" 
    WHERE idUser=?');
    $modifUser->execute(array($idUser));
    $modifUser = $modifUser->fetch(PDO::FETCH_OBJ);

    
}

$user = getUserById($idUser);
$_SESSION['user'] = $user;
$query = $conn->prepare('SELECT nomFormation FROM formation, utilisateur WHERE formation.idFormation = utilisateur.formation AND idUser=?');
$query->execute(array($idUser));
$formation = $query->fetch(PDO::FETCH_OBJ);



$titre = "Colearnio - Profil";
include_once __DIR__ . '/View/header_monespace.php';

?>

<section>

    <div class="container py-5">
        <form method="POST" action="">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 200px;">
                            <div class="my-3">
                                <h3 class="mb-2"><?= ucfirst($user->pseudo); ?></h3>

                                <button type="button" class="btn btn-outline-success" id="edit_profile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                    </svg>
                                    Editer le profil
                                </button>
                            </div>

                            <input readonly style="width:100%;" class="text-center " type="text" name="description" value="<?= $user->descripUser; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 ">
                    <div class="card mb-4 ps-2">
                        <h5 class="text-center" style="padding:15px" ;>Informations Personnelles</h5>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;" ;>Nom</p>
                            </div>
                            <div class="info col-sm-9">
                                <input readonly class="ps-2  mb-0" type="text" name="nom" value="<?= $user->nom; ?>">
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;" ;>Prenom</p>
                            </div>
                            <div class="info col-sm-9">
                                <input readonly class="ps-2  mb-0" type="text" name="prenom" value="<?= $user->prenom; ?>">
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Email</p>
                            </div>
                            <div class="info col-sm-9">
                                <h6 class="text-muted ps-2"><?= $user->email; ?></h6>
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Date de naissance</p>
                            </div>
                            <div class="info col-sm-9">
                                <input readonly class="ps-2  mb-0" type="date" name="dateNaiss" value="<?= $user->dateNaiss; ?>">
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Telephone</p>
                            </div>
                            <div class="info col-sm-9">
                                <input readonly class="ps-2  mb-0" type="text" name="tel" value="<?= $user->telephone; ?>">
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Ville</p>
                            </div>
                            <div class="info col-sm-9">
                                <select class="form-select" name="ville" id="ville">
                                    <option value="0" <?php if (!$_SESSION['user']->ville) echo ' selected '; ?>>Sélectionner une ville</option>
                                    <?php
                                    $villes = getVilles();

                                    if ($villes) {
                                        foreach ($villes as $ville) {
                                            echo '<option value="' . $ville->idVille . '"';
                                            if ($ville->idVille == $_SESSION['user']->ville) echo ' selected';
                                            echo '>' . $ville->nom_ville . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                               

                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Rue</p>
                            </div>
                            <div class="info col-sm-9">
                                <input readonly class="ps-2  mb-0" type="text" name="rue" value="<?= $user->rue; ?>">
                            </div>
                        </div>

                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Code Postal</p>
                            </div>
                            <div class="info col-sm-9">
                                <input readonly class="ps-2  mb-0" type="text" name="codePost" value="<?= $user->codePost; ?>">
                            </div>
                        </div>



                    </div>
                    </br>
                    <div class="card mb-4 ps-2">
                        <h5 class="text-center" style="padding:15px" ;>Formation</h5>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Niveau</p>
                            </div>
                            <div class="info col-sm-9">
                                <select class="form-control" name="niveau" id="niveau">
                                    <option value="0" <?php if (!$user->niveau) echo ' selected '; ?>>Sélectionner une ville</option>
                                    <option value="1" <?php if ($user->niveau==1) echo ' selected '; ?>>Baccalauréat</option>
                                    <option value="2" <?php if ($user->niveau==2) echo ' selected '; ?>>Licence 1</option>
                                    <option value="3" <?php if ($user->niveau==3) echo ' selected '; ?>>Licence 2</option>
                                    <option value="4" <?php if ($user->niveau==4) echo ' selected '; ?>>Licence 3</option>
                                    <option value="5" <?php if ($user->niveau==5) echo ' selected '; ?>>Master 1 </option>
                                    <option value="6" <?php if ($user->niveau==6) echo ' selected '; ?>>Master 2</option>
                                </select>
                                    


                            </div>
                        </div>

                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Specialite</p>
                            </div>
                            <div class="info col-sm-9">
                                <input readonly class="ps-2  mb-0" type="text" name="specialite" value="<?php if ($formation) echo $formation->nomFormation; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-2">
                        <button type="submit" class="btn btn-outline-primary ms-1 d-none" name="submit" id="btn-modifier">Enregistrer les modifications</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php


?>
<script src="/script/profile.js"></script>

<?php
include_once __DIR__ . '/View/footer_index.php';
?>