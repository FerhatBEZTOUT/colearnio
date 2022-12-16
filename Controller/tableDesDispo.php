<?php
if (!session_id()) {
    session_start();
}

include_once __DIR__ . '/../Model/connexionBD.php';
include __DIR__ . '/../query/user.php';

$conn = newConnect();
$user = $_SESSION['user'];

$query = "SELECT niveau,ville FROM utilisateur where  idUser = ?";
$query = $conn->prepare($query);
$query->execute(array($_SESSION['user']->idUser));


$etreDispo  = "SELECT idUser,intitule,dateDeb,dateFin FROM cours,etreDispo where cours.idCours=etreDispo.idCours AND idUser = $user->idUser";
$etreDispo = $conn->prepare($etreDispo);
$etreDispo->execute();

$tab = [];

//on format pour html
while ( $row = $etreDispo->fetch() ) {
    $tab[] = $row;
}

// Return the messages as a JSON-encoded array
echo json_encode($tab);
