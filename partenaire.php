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
    include __DIR__.'/query/partenaire.php';

    $conn = newConnect();

    $query = getPartenaire();
    $infoPartenaire = getPartenaire();
    // $etreDispo = $query->fetch(PDO::FETCH_OBJ);
    // var_dump($etreDispo);
    $cours = getCours();
    $ville = getVille();
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

        <h2 style="text-align:center;">Trouver des partenaires</h2>
        <div class="container py-5 offset-md-2">
            <div class="selection row">
                <div class="col-lg-4">
                    <div class="col-sm-3">
                        <p class="mb-0" style="font-weight:bold;">Cours</p>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-select" id="cours" name="cours" required>
                            <option value="">Cours</option>
                            <?php if ($cours->rowCount() > 0) {
                                while ($row = $cours->fetch(PDO::FETCH_OBJ)) { ?>
                                    <option value="<?=$row->idCours;?>"><?= $row->intitule;?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-sm-3">
                        <p class="mb-0" style="font-weight:bold;">Niveau</p>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-select" id="niveau" name="niveau" required>
                            <option value="">Niveau</option>
                            <option value="1">Bac</option>
                            <option value="2">L1</option>
                            <option value="3">L2</option>
                            <option value="4">L3</option>
                            <option value="5">M1</option>
                            <option value="5">M2</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="col-sm-3">
                        <p class="mb-0" style="font-weight:bold;">Ville</p>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-select" id="ville" name="ville" required>
                            <option value="">Ville</option>
                            <?php if ($ville->rowCount() > 0) {
                                while ($row = $ville->fetch(PDO::FETCH_OBJ)) { ?>
                                    <option value="<?=$row->idVille;?>"><?= $row->nom_ville;?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    <div id="cr">
        <div class="container"> 
            <div class="row">
                <?php $i = 1; while ($data=$query->fetch()){?>
                <div class="col-lg-4">
                    <div class="card partenaire-container">
                        <div class="row partenaire" data-name="<?=$i;?>">
                            <div class="col-sm-8" style="margin: auto;";>
                                <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100%; margin-left: 5px; margin-top:5px;">
                            </div>
                            <div class="col-sm-12" style="text-align:center";>
                                <h5><?= $data['pseudo'];?></h5>
                                <p><?= $data['nomFormation'];?></p>
                                <p><?= $data['intitule'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
                } ?>
            </div>
        </div>   

        <div class="partenaire-preview">
            <?php $j = 1; while ($data1=$infoPartenaire->fetch()){?>
            <div class="preview" data-target="<?=$j;?>">
                <i class="fas fa-times"></i>
                <div class="image-part">
                    <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid">
                </div>
                <div class="";>
                    <h5><?= $data1['pseudo'];?></h5>
                    <p><?= $data1['Motivation'];?></p>
                    <p><?= $data1['intitule'];?></p>
                    <!-- add ville -->
                    <p><?//= $data1['descripUser'];?></p>
                </div>
                <div class="buttons">
                    <a href="#" class="btn btn-outline-primary ms-1">Contacter</a>
                    <a href="profileAutre.php?iduser=<?=$data1['idUser'];?>" class="btn btn-outline-primary ms-1">Voir profil</a>
                </div>
            </div>
            <?php $j++;
            } ?>
        </div>
    </div>
</body>
</html>
