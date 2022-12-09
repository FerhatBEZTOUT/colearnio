<?php
    if(!session_id()){
        session_start();
    }

    include_once __DIR__.'/Model/connexionBD.php';  
    include __DIR__.'/query/user.php';
    include __DIR__.'/query/profileAutre.php';

    $conn = newConnect(); 
    $ProfilUser = getUserById($_GET['iduser']);
    $formation = getFormationByUserId($_GET['iduser']);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inscr.css">
    <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 200px;">
                            <h5 class="my-3"><?=$ProfilUser->pseudo;?></h5>
                            <!-- <p class="text-muted mb-1"><?//=$user->descripUser;?></p> -->
                            </br>
                            <div class="d-flex justify-content-center mb-2">
                                <form method="POST" action="">
                                <button type="button" class="btn btn-outline-primary ms-1" name="contacter">Contacter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <h5 class="text-center" style="padding:15px";>Informations Personnelles</h5>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;";>Nom</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->nom;?></p>
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;";>Prenom</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->prenom;?></p>
                            </div>
                        </div>
                       
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Email</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->email;?></p>
                            </div>
                        </div>
                        <?php if($ProfilUser->dateNaiss != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Date de naissance</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->dateNaiss;?></p>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if($ProfilUser->telephone != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Telephone</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->telephone;?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($ProfilUser->ville != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Ville</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->ville;?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($ProfilUser->rue != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Rue</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->rue;?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($ProfilUser->codePost != NULL){?>
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Code Postal</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->codePost;?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    </br>

                    <div class="card mb-4">
                        <h5 class="text-center" style="padding:15px";>Formation</h5>
                        <?php if($ProfilUser->niveau != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Niveau</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$ProfilUser->niveau;?></p>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Specialite</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$formation->nomFormation;?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>