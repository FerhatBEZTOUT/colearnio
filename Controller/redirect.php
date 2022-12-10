<?php


function redirectFromLanding(){
    if(isset($_SESSION['connecté'])) {
        if($_SESSION['user']->isAdmin) {
            header('location:../dashboard.php');
        } else {
            header('location:../profile.php');  // à changer vers (partenaire.php)
        }
        die();
    }
}


function redirectFromMonEspace(){
    if(isset($_SESSION['connecté'])) {
        if($_SESSION['user']->isAdmin) {
            header('location:../dashboard.php');
            die();
        }
        
    } else {
        header('location:../connexion.php');
    }
}


function redirectFromDashboard(){
    if(isset($_SESSION['connecté'])) {
        if(!$_SESSION['user']->isAdmin) {
            header('location:../partenaire.php');
            die();
        }
        
    } else {
        header('location:../connexion.php');
    }
}

?>