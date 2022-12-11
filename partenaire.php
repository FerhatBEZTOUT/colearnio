<?php
if (!session_id()) {
    session_start();
}

include_once __DIR__ . '/Model/connexionBD.php';
include __DIR__ . '/query/user.php';

$conn = newConnect();
//use $_GET[]
$user = getUserById(3);

$query = "SELECT nomFormation FROM formation, suivre WHERE formation.idFormation = suivre.idFormation ";
$query = $conn->prepare($query);
$query->execute();
$formation = $query->fetch(PDO::FETCH_OBJ);
//var_dump($formation);

$cours = "SELECT intitule FROM cours,etreDispo where cours.idCours=etreDispo.idCours ";
$cours = $conn->prepare($cours);
$cours->execute();
$cour = $cours->fetch(PDO::FETCH_OBJ);
//var_dump($cour);

$motivation = "SELECT Motivation FROM etreDispo where   idUser = $user->idUser";
$motivation = $conn->prepare($motivation);
$motivation->execute();
$motiv = $motivation->fetch(PDO::FETCH_OBJ);
//var_dump($motiv);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/inscr.css">
    <script src="script/script.js" defer></script>
    <title>Document</title>
</head>
<body>
<form method="post" action="">
    <section>
        <h2 style="text-align:center;margin-top: 5%;margin-right: 10%">Trouver des partenaires</h2>

        <div class="container py-5">
            <div style="margin-top: 2%;margin-left: 5%; display: flex" class="row">
                <div class="col-lg-3">
                    <div class="col-sm-4">
                        <p class="mb-0" style="font-weight:bold;margin-left: 40%" ;>Cours</p>
                    </div>
                    <div class="col-sm-4">
                        <select style="margin-left: 30%" class="form-select 1" name="cours">
                            <option selected>
                                <?php
                                $sql = "SELECT * FROM cours";
                                $result = $conn->query($sql);
                                if ($result->rowCount() > 0) {
                                    while ($row = $result->fetch()) {
                                        echo "<option value='" . $row['idCours'] . "'>" . $row['intitule'] . "</option>";
                                    }
                                }
                                ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="col-sm-4">
                        <p class="mb-0" style="font-weight:bold;margin-left: 40%;ma" ;>Niveau</p>
                    </div>
                    <div class="col-sm-4">
                        <select style="margin-left: 30%" class="form-select 2" name="niveau">
                            <option selected>
                                <?php
                                $sql = "SELECT * FROM utilisateur";
                                $result = $conn->query($sql);
                                if ($result->rowCount() > 0) {
                                    while ($row = $result->fetch()) {
                                        echo "<option value='" . $row['idUser'] . "'>" . $row['niveau'] . "</option>";
                                    }
                                }
                                ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="col-sm-4">
                        <p class="mb-0" style="font-weight:bold;margin-left: 40%" ;>Ville</p>
                    </div>
                    <div class="col-sm-4">
                        <select style="margin-left: 30%" class="form-select 3" name="ville">
                            <option selected>
                                <?php
                                $sql = "SELECT * FROM ville";
                                $result = $conn->query($sql);
                                if ($result->rowCount() > 0) {
                                    while ($row = $result->fetch()) {
                                        echo "<option value='" . $row['idVille'] . "'>" . $row['nom_ville'] . "</option>";
                                    }
                                }
                                ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="col-sm-4">
                        <p class="mb-0" style="font-weight:bold;margin-left: 40%;color: transparent" ;>ajouter</p>
                    </div>
                    <div class="col-sm-4">
                        <input style="background: #ffffff;border: 1px solid black;width: 95px;height: 37px"
                               type="submit" name="submit" value="Valider"></div>

                </div>
            </div>
        </div>
</form>
</br>



<div class="container">
    <div style="margin-left: 10%" class="row">
        <div class="col-lg-4">
            <div class="card partenaire-container">
                <div class="row partenaire" data-name="p-1">
                    <div class="col-sm-8" style="margin: auto;" ;>
                        <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid"
                             style="width: 100%; margin-left: 5px; margin-top:5px;">
                    </div>
                    <div class="col-sm-12" style="text-align:center" ;>
                        <h5 class="my-3"><?= $user->pseudo; ?></h5>
                        <p><?= $formation->nomFormation; ?></p>
                        <p><?= $cour->intitule; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card partenaire-container">
                <div class="row partenaire" data-name="p-2">
                    <div class="col-sm-8" style="margin: auto;" ;>
                        <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid"
                             style="width: 100%; margin-left: 5px; margin-top:5px;">
                    </div>
                    <div class="col-sm-12" style="text-align:center" ;>
                        <h5 class="my-3"><?= $user->pseudo; ?></h5>
                        <p><?= $formation->nomFormation; ?></p>
                        <p><?= $cour->intitule; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card partenaire-container">
                <div class="row partenaire" data-name="p-3">
                    <div class="col-sm-8" style="margin: auto;" ;>
                        <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid"
                             style="width: 100%; margin-left: 5px; margin-top:5px;">
                    </div>
                    <div class="col-sm-12" style="text-align:center" ;>
                        <h5 class="my-3"><?= $user->pseudo; ?></h5>
                        <p><?= $formation->nomFormation; ?></p>
                        <p><?= $cour->intitule; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
<div class="partenaire-preview">
    <div class="preview" data-target="p-1">
        <i class="fas fa-times"></i>
        <div class="image-part">
            <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid">
        </div>
        <div class="" ;>
            <h5 class="my-3"><?= $user->pseudo; ?></h5>
            <p><?= $formation->nomFormation; ?></p>
            <p><?= $cour->intitule; ?></p>
            <p><?= $motiv->Motivation; ?></p>
        </div>
        <div class="buttons">
            <a href="#" class="btn btn-outline-primary ms-1">Contacter</a>
            <a href="#" class="btn btn-outline-primary ms-1">Voir profil</a>
        </div>
    </div>
    <div class="preview" data-target="p-2">
        <i class="fas fa-times"></i>
        <div class="image-part">
            <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid">
        </div>
        <div class="" ;>
            <h5>Pseudo 2</h5>
            <p>Specialite</p>
            <p>Cours</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, incidunt blanditiis, perspiciatis
                itaque reprehenderit animi earum illum dignissimos voluptatibus harum quos fuga ducimus veniam ullam
                voluptatum quam libero repellendus maxime?</p>
        </div>
        <div class="buttons">
            <a href="#" class="btn btn-outline-primary ms-1">Contacter</a>
            <a href="profileAutre.php" class="btn btn-outline-primary ms-1">Voir profil</a>
        </div>
    </div>
    <div class="preview" data-target="p-3">
        <i class="fas fa-times"></i>
        <div class="image-part">
            <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid">
        </div>
        <div class="" ;>
            <h5>Pseudo 2</h5>
            <p>Specialite</p>
            <p>Cours</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, incidunt blanditiis, perspiciatis
                itaque reprehenderit animi earum illum dignissimos voluptatibus harum quos fuga ducimus veniam ullam
                voluptatum quam libero repellendus maxime?</p>
        </div>
        <div class="buttons">
            <a href="#" class="btn btn-outline-primary ms-1">Contacter</a>
            <a href="profileAutre.php" class="btn btn-outline-primary ms-1">Voir profil</a>
        </div>
    </div>
</div>


</body>
</html>