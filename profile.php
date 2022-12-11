<?php
    if(!session_id()){
        session_start();
    }
    //traiter date de naissance et image

    // __DIR__ c'est pour le site Alwaysdata , 
    /// ne pas mettre __DIR__ cause des erreurs, il arrive pas à trouver le chemin relatif
    include_once __DIR__.'/Model/connexionBD.php';  
    include __DIR__.'/query/user.php';

    $conn = newConnect(); 
   
    //var_dump($user);

    

    if(isset($_POST['submit'])){
        // echo "yes";
        $modifUser = $conn->prepare('UPDATE utilisateur set nom="'.$_POST['nom'].'", prenom="'.$_POST['prenom'].'", pseudo="'.$_POST['pseudo'].'", descripUser="'.$_POST['description'].'", rue="'.$_POST['rue'].'", codePost="'.$_POST['codePost'].'", ville="'.$_POST['ville'].'", telephone="'.$_POST['tel'].'", email="'.$_POST['email'].'", niveau="'.$_POST['niveau'].'" WHERE idUser=2');
        $modifUser->execute();
        $modifUser = $modifUser->fetch(PDO::FETCH_OBJ);

        $form = $conn->prepare('SELECT idFormation FROM suivre WHERE idUser = 2');
        $form->execute();
        $form = $form->fetch(PDO::FETCH_OBJ);
        //var_dump($form);
        //$id = intval($form[0]);

        $modiFormation = $conn->prepare('UPDATE FORMATION set nomFormation="'.$_POST['specialite'].'" WHERE idFormation=1'); //$form->idFormation
        $modiFormation->execute();
        $modiFormation = $modiFormation->fetch(PDO::FETCH_OBJ);
    }

    $user = getUserById(2);  

    $query = $conn->prepare('SELECT nomFormation FROM formation, suivre WHERE formation.idFormation = suivre.idFormation AND idUser=2');
    $query->execute();
    $formation = $query->fetch(PDO::FETCH_OBJ);
    //var_dump($formation);
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
    <title>Profil</title>
</head>
<body>
    <section>
        <div class="container py-5">
            <form method="POST" action="">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="img/user.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 200px;">
                            <h5 class="my-3"><input type="text" name="pseudo" value="<?=$user->pseudo;?>"></h5>
                                <input type="text" name="description" value="<?=$user->descripUser;?>">
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
                                <input class="text-muted mb-0" type="text" name="nom" value="<?=$user->nom;?>">
                            </div>
                        </div>
                       
                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;";>Prenom</p>
                            </div>
                            <div class="info col-sm-9">
                                <input class="text-muted mb-0" type="text" name="prenom" value="<?=$user->prenom;?>">
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Email</p>
                            </div>
                            <div class="info col-sm-9">
                                <input class="text-muted mb-0" type="text" name="email" value="<?=$user->email;?>">
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
                            <input class="text-muted mb-0" type="text" name="tel" value="<?=$user->telephone;?>">
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Ville</p>
                            </div>
                            <div class="info col-sm-9">
                            <input class="text-muted mb-0" type="text" name="ville" value="<?=$user->ville;?>">
                            </div>
                        </div>

                        <div class="case row">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Rue</p>
                            </div>
                            <div class="info col-sm-9">
                            <input class="text-muted mb-0" type="text" name="rue" value="<?=$user->rue;?>">
                            </div>
                        </div>
                        
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Code Postal</p>
                            </div>
                            <div class="info col-sm-9">
                            <input class="text-muted mb-0" type="text" name="codePost" value="<?=$user->codePost;?>">
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
                                <input class="text-muted mb-0" type="text" name="niveau" value="<?=$user->niveau;?>">
                            </div>
                        </div>
                        <div class="case row" style="margin-bottom:10px;">
                            <div class="donnee col-sm-3">
                                <p class="mb-0" style="font-weight:bold;">Specialite</p>
                            </div>
                            <div class="info col-sm-9">
                                <input class="text-muted mb-0" type="text" name="specialite" value="<?=$formation->nomFormation;?>">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-2">
                        <input type="submit" class="btn btn-outline-primary ms-1" name="submit" value="Update">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
    
</body>
</html>