<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#cours").on("change",function(){
            var cours=$("#cours").val();
            if(cours){
                $.ajax({
                    type: 'POST',
                    url: './AJAX/partenaire.php',
                    data: {cours:cours},
                    success: function(response){
                        //alert(response);
                        $("#cr").html(response);
                    }
                });
            }else{
                $("#cr").html("");
            }

            $("#niveau").on("change",function(){
            var niveau=$("#niveau").val();
            if(niveau){
                $.ajax({
                    type: 'POST',
                    url: './AJAX/partenaire.php',
                    data: {niveau:niveau, cours:cours},
                    success: function(response){
                        //alert(response);
                        $("#cr").html(response);
                    }
                });

                $("#ville").on("change",function(){
                var ville=$("#ville").val();
                if(ville){
                    $.ajax({
                        type: 'POST',
                        url: './AJAX/partenaire.php',
                        data: {ville:ville, niveau:niveau, cours:cours},
                        success: function(response){
                            //alert(response);
                            $("#cr").html(response);
                        }
                    });
                }else{
                    $("#cr").html("");
                }
                });
            }else{
                $("#cr").html("");
            }
            
        });
        });

    })
</script>
<?php
    if(!session_id()){
        session_start();
    }

    include_once __DIR__.'/Model/connexionBD.php';  
    include __DIR__.'/query/user.php';

    $conn = newConnect(); 

    $query = $conn->prepare('SELECT * FROM etreDispo, utilisateur, formation, cours WHERE etreDispo.idCours = cours.idCours AND etreDispo.idUser = utilisateur.idUser AND formation.idFormation = utilisateur.formation');
    $query->execute();

    $test = $conn->prepare('SELECT * FROM etreDispo, utilisateur, formation, cours WHERE etreDispo.idCours = cours.idCours AND etreDispo.idUser = utilisateur.idUser AND formation.idFormation = utilisateur.formation');
    $test->execute();
    // $etreDispo = $query->fetch(PDO::FETCH_OBJ);
    // var_dump($etreDispo);

    $cours = "SELECT idCours, intitule FROM cours";
    $cours = $conn->prepare($cours);
    $cours->execute();

    $ville = $conn->prepare("SELECT idVille, nom_ville FROM ville");
    $ville->execute();
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
    <section>
        <h2 style="text-align:center;">Trouver des partenaires</h2>
        <div class="container py-5">
            <div style="margin-top: 2%;margin-left: 5%; display: flex" class="row">
                <div class="col-lg-3">
                    <div class="col-sm-4">
                        <p class="mb-0" style="font-weight:bold;margin-left: 40%" ;>Cours</p>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-select">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="col-sm-4">
                        <p class="mb-0" style="font-weight:bold;margin-left: 40%;ma">Niveau</p>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-select">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="col-sm-4">
                        <p class="mb-0" style="font-weight:bold; margin-left: 40%;">Ville</p>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-select">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
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
        <div class="container"> 
            <div class="row">
                <div class="col-lg-4">
                    <div class="card partenaire-container">
                        <div class="row partenaire" data-name="p-1">
                                <div class="col-sm-8" style="margin: auto;";>
                                    <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100%; margin-left: 5px; margin-top:5px;">
                                </div>
                                <div class="col-sm-12" style="text-align:center";>
                                    <h5>Pseudo</h5>
                                    <p>Specialite</p>
                                    <p>Cours</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card partenaire-container">
                        <div class="row partenaire" data-name="p-2">
                                <div class="col-sm-8" style="margin: auto;";>
                                    <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100%; margin-left: 5px; margin-top:5px;">
                                </div>
                                <div class="col-sm-12" style="text-align:center";>
                                    <h5>Pseudo 2</h5>
                                    <p>Specialite</p>
                                    <p>Cours</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card partenaire-container">
                        <div class="row partenaire" data-name="p-3">
                            <div class="col-sm-8" style="margin: auto;";>
                                <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100%; margin-left: 5px; margin-top:5px;">
                            </div>
                            <div class="col-sm-12" style="text-align:center";>
                                <h5>Pseudo 3</h5>
                                <p>Specialite</p>
                                <p>Cours</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
                 ?>
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
        <div class="";>
            <h5>Pseudo</h5>
            <p>Specialite</p>
            <p>Cours</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, incidunt blanditiis, perspiciatis itaque reprehenderit animi earum illum dignissimos voluptatibus harum quos fuga ducimus veniam ullam voluptatum quam libero repellendus maxime?</p>
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
        <div class="";>
            <h5>Pseudo 2</h5>
            <p>Specialite</p>
            <p>Cours</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, incidunt blanditiis, perspiciatis itaque reprehenderit animi earum illum dignissimos voluptatibus harum quos fuga ducimus veniam ullam voluptatum quam libero repellendus maxime?</p>
        </div>
        <div class="buttons">
            <a href="#" class="btn btn-outline-primary ms-1">Contacter</a>
            <a href="#" class="btn btn-outline-primary ms-1">Voir profil</a>
        </div>
    </div>
    <div class="preview" data-target="p-3">
        <i class="fas fa-times"></i>
        <div class="image-part">
            <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid">
        </div>
        <div class="";>
            <h5>Pseudo</h5>
            <p>Specialite</p>
            <p>Cours</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, incidunt blanditiis, perspiciatis itaque reprehenderit animi earum illum dignissimos voluptatibus harum quos fuga ducimus veniam ullam voluptatum quam libero repellendus maxime?</p>
        </div>
        <div class="buttons">
            <a href="#" class="btn primary-button">Contacter</a>
            <a href="#" class="btn primary-button">Voir profil</a>
        </div>
    </div>
</div>

</body>
</html>
