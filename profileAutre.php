<?php
if(!session_id()){
    session_start();
}

include_once __DIR__.'/Model/connexionBD.php';
include __DIR__.'/query/user.php';
include __DIR__.'/query/profile.php';


$conn = newConnect();
$ProfilUser = getUserById($_GET['iduser']);
$formation = getFormationByUserId($_GET['iduser']);

$x= $ProfilUser->ville;
$localisation = "SELECT lat,lng  FROM ville WHERE idVille = $x";
$localisation = $conn->prepare($localisation);
$localisation->execute();
$localisation = $localisation->fetch(PDO::FETCH_OBJ);

if (isset($_GET['iduser'])) {
    $foreignUser = getUserById($_GET['iduser']);
    if ($foreignUser) $error=false; else $error=true;


}

if (!$error)
    $titre = 'Colearnio - '.$foreignUser->nom.' '.$foreignUser->prenom;
else {
    $titre = 'Colearnio - Profil introuvable';
}

include_once __DIR__ . '/View/header_monespace.php';
if (!$error) {

    ?>

    <style>
        .info, .card input{

            padding:1px;
            margin-bottom: 4px;
            width: 300px;
            border-radius: 10px;
            color: black;
        }
    </style>
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
                                <?=$ProfilUser->nom;?></p>
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;";>Prenom</p>
                            </div>
                            <div class="info col-sm-9">
                                <?=$ProfilUser->prenom;?></p>
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Email</p>
                            </div>
                            <div class="info col-sm-9">
                                <?=$ProfilUser->email;?></p>
                            </div>
                        </div>
                        <?php if($ProfilUser->dateNaiss != NULL){?>
                            <div class="case row">
                                <div class="donnee col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;">Date de naissance</p>
                                </div>
                                <div class="info col-sm-9">
                                    <?=$ProfilUser->dateNaiss;?></p>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($ProfilUser->telephone != NULL){?>
                            <div class="case row">
                                <div class="donnee col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;">Telephone</p>
                                </div>
                                <div class="info col-sm-9">
                                    <?=$ProfilUser->telephone;?></p>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($ProfilUser->ville != NULL){?>
                            <div class="case row">
                                <div class="donnee col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;">Ville</p>
                                </div>
                                <div class="info col-sm-9">
                                    <?php  $r = getVilleOfUser($ProfilUser->ville); if($r) echo $r->nom_ville; ?></p>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($ProfilUser->rue != NULL){?>
                            <div class="case row">
                                <div class="donnee col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;">Rue</p>
                                </div>
                                <div class="info col-sm-9">
                                    <?=$ProfilUser->rue;?></p>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($ProfilUser->codePost != NULL){?>
                            <div class="case row" style="margin-bottom:10px;">
                                <div class="donnee col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;">Code Postal</p>
                                </div>
                                <div class="info col-sm-9">
                                    <?=$ProfilUser->codePost;?></p>
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
                
                                    
                                     <?php if (!$ProfilUser->niveau) echo ' Aucun</p>'; ?>
                                     <?php if ($ProfilUser->niveau==1) echo '  Baccalauréat</p> '; ?>
                                     <?php if ($ProfilUser->niveau==2) echo '  Licence 1</p> '; ?>
                                     <?php if ($ProfilUser->niveau==3) echo '  Licence 2</p> '; ?>
                                     <?php if ($ProfilUser->niveau==4) echo '  Licence 3</p> '; ?>
                                     <?php if ($ProfilUser->niveau==5) echo '  Master 1</p> '; ?>
                                     <?php if ($ProfilUser->niveau==6) echo '  Master 2</p> '; ?>                               
                                </div>
                            </div>
                        <?php } ?>
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Specialite</p>
                            </div>
                            <div class="info col-sm-9">
                                <?=$formation->nomFormation;?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} else {
    ?>

    <?php

    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
     <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
     <div>
      Vous tenter de visualiser un profil inexistant
     </div>
   </div>';
}
?>

<script>
       function getLocation() {
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
        })


    var map = L.map('map').setView([<?=$localisation->lat;?>, <?=$localisation->lng;?>], 12);


    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 12,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var markerclient = L.marker([ <?=$localisation->lat;?>, <?=$localisation->lng;?> ]).addTo(map); // si on veut afficher le marker du client et non pas un rond

    var circle = L.circle([<?=$localisation->lat;?>, <?=$localisation->lng;?>], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 1000
    }).addTo(map);
</script>


<?php

include_once __DIR__.'/View/footer_index.php';

?>
