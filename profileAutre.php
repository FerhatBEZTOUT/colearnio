<?php
    if(!session_id()){
        session_start();
    }

    include_once __DIR__.'/Model/connexionBD.php';  
    include __DIR__.'/query/user.php';

    $conn = newConnect(); 
    //use $_GET[]
    $user = getUserById(2); 
    
    $query = $conn->prepare('SELECT nomFormation FROM formation, suivre WHERE formation.idFormation = suivre.idFormation AND idUser=2');
    $query->execute();
    $formation = $query->fetch(PDO::FETCH_OBJ);


    $x= $user->ville;
    $localisation = "SELECT lat,lng  FROM ville WHERE idVille = $x";
    $localisation = $conn->prepare($localisation);
    $localisation->execute();
    $localisation = $localisation->fetch(PDO::FETCH_OBJ);



    //if(isset($_POST['contacter'])) header('Location: messagerie.php');
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inscr.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
            crossorigin=""></script>
    <link rel="stylesheet" href="css/map.css">
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
                            <h5 class="my-3"><?=$user->pseudo;?></h5>
                            <p class="text-muted mb-1"><?=$user->descripUser;?></p>
                            </br>
                            <div class="d-flex justify-content-center mb-2">
                                <form method="POST" action="">
                                <button type="button" class="btn btn-outline-primary ms-1" name="contacter">Contacter</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="map" style="height: 24rem"></div>
                </div>






                <div class="col-lg-8">
                    <div class="card mb-4">
                        <h5 class="text-center" style="padding:15px";>Informations Personnelles</h5>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;";>Nom</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->nom;?></p>
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;";>Prenom</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->prenom;?></p>
                            </div>
                        </div>
                       
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Email</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->prenom;?></p>
                            </div>
                        </div>
                        <?php if($user->dateNaiss != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Date de naissance</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->dateNaiss;?></p>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if($user->telephone != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Telephone</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->telephone;?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($user->ville != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Ville</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->ville;?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($user->rue != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Rue</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->rue;?></p>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($user->codePost != NULL){?>
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Code Postal</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->codePost;?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    </br>

                    <div class="card mb-4">
                        <h5 class="text-center" style="padding:15px";>Formation</h5>
                        <?php if($user->niveau != NULL){?>
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Niveau</p>
                            </div>
                            <div class="info col-sm-9">
                                <p class="text-muted mb-0"><?=$user->niveau;?></p>
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






    <!-- Make sure you put this AFTER Leaflet's CSS -->

    <script>
     /*   function getLocation() {
            return new Promise(function(resolve, reject) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(resolve, reject);
                } else {
                    reject('Geolocation is not supported by this browser.');
                }
            });
        }

        // get the geolocation of the user
        getLocation().then(function(position) {
            // get the latitude and longitude
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // create a new object with the latitude and longitude
            var center = {
                lat: lat,
                lng: lng

            };

            // return the object
            return center;
        }).then(function(center) {
            // create a new map




            var map = L.map('map').setView([center.lat, center.lng], 13);


            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            var marker= L.marker([center.lat, center.lng]).addTo(map);
            var markerclient = L.marker([ <?=$localisation->lat;?>, <?=$localisation->lng;?> ]).addTo(map);
        })*/


        var map = L.map('map').setView([<?=$localisation->lat;?>, <?=$localisation->lng;?>], 12);


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 12,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        //var markerclient = L.marker([ <?//=$localisation->lat;?>//, <?//=$localisation->lng;?>// ]).addTo(map);  si on veut afficher le marker du client et non pas un rond

        var circle = L.circle([<?=$localisation->lat;?>, <?=$localisation->lng;?>], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 1000
        }).addTo(map);
    </script>

</body>
</html>