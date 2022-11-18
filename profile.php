<?php
    if(!session_id()){
        session_start();
    }
    include_once 'Model/connexionBD.php';
    include 'user.php';

    $user = getUserById(1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
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
                            <h5 class="my-3"><?php user->pseudo ?></h5>
                            <p class="text-muted mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis odit facilis maxime earum dolorum aspernatur. Ducimus est officiis accusantium accusamus, amet tenetur sunt quia iusto soluta, mollitia dignissimos deserunt quisquam?</p>
                            </br>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-outline-primary ms-1">Contacter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <h5 class="text-center" style="padding:15px";>Informations Personnelles</h5>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;";>Nom Complet</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0">Someone Smith</p>
                            </div>
                        </div>
                       
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Email</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0">example@example.com</p>
                            </div>
                        </div>
                       
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Age</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0">18</p>
                            </div>
                        </div>
                        
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Telephone</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0">999-9785</p>
                            </div>
                        </div>
                        
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Adresse</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0">Tizi-m3ali</p>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="card mb-4">
                        <h5 class="text-center" style="padding:15px";>Formation</h5>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Niveau</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0">Master 1</p>
                            </div>
                        </div>
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Specialite</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0">Data Scientist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>