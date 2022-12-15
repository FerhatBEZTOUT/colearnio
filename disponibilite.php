<?php
if (!session_id()) {
    session_start();
}

include_once __DIR__ . '/Model/connexionBD.php';
include __DIR__ . '/query/user.php';


$conn = newConnect();
//$user = getUserById(3);

$user = getUserById('id');

$query = "SELECT niveau,ville FROM utilisateur where  idUser = ?";
$query = $conn->prepare($query);
$query->execute();
//$for = $query->fetch(PDO::FETCH_OBJ);
//var_dump($for);
$titre = "Colearnio - Profil";
include_once __DIR__ . '/View/header_monespace.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="css/inscr.css">
    <title>Document</title>
</head>
<body>
<section>
    <div class="container py-5">
        <h1 class="text-center" style=" margin-right: 10%" >Ajouter une disponibilité</h1>
        <form method="POST" action="">
            <div style="margin-top: 5%" class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div  class="card-body text-center">

                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin: 15px" >
                                        User</p>
                                </div>
                                <div class="col-sm-3">
                                    <input class="ps-2 form-control mb-0" style="background: white;width: 200px;margin-top: 10%; border: 1px solid black"
                                           id="idUser" name="idUser" value="<?= $user->idUser; ?>">

                                </div>
                            </div>
                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin: 15px" >
                                        Ville</p>
                                </div>
                                <div class="col-sm-3">
                                    <input class="ps-2 form-control mb-0" style="background: white;width: 200px;margin-top: 10%; border: 1px solid black"
                                           id="idVille" name="idVille" value="<?=$user->ville;?>">

                                </div>
                            </div>
                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin: 15px">
                                        Cours</p>
                                </div>
                                <div class="col-sm-3">
                                    <select style="border: 1px solid black;margin-top: 10%;margin-top: 10%;width: 200%;height: 30px"
                                            class="form-select"
                                            name="idCours">
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


                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin-top: 10px">
                                        Motivation</p>
                                </div>
                                <div class="col-sm-3">
                                    <input style="background: white;width: 200px;margin-top: 10%; border: 1px solid black"
                                           class="inp" name="motivation">
                                </div>
                            </div>
                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin-top: 10%">
                                        Datedebut</p>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date"
                                           style="background: white;width: 200px;margin-top: 10%; border: 1px solid black"
                                           class="inp" name="dateDeb">
                                </div>
                            </div>
                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin: 15px">
                                        dateFin</p>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date"
                                           style="background: white;width: 200px;margin-top: 10%; border: 1px solid black"
                                           name="dateFin">
                                </div>
                            </div>
                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin-top: 15%;margin-right: 5%" >
                                        typeDispon</p>
                                </div>
                                <div class="col-sm-3">
                                    <select style="border: 1px solid black;margin-top: 10%;width: 200%;height: 30px"
                                            class="form-select"
                                            name="typeDispo">
                                        <option></option>
                                        <option>Presentiel</option>
                                        <option>Distanciel</option>
                                        <option>les deux</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex;margin-top: 5%">
                                <div class="col-sm-3">
                                    <p class="mb-0" style="font-weight:bold;margin: 15px">
                                        enDuo </p>
                                </div>
                                <div class="col-sm-3">
                                    <input style="background: white;width: 200px;margin-top: 10%; border: 1px solid black"
                                           class="inp" name="enDuo">
                                </div>
                            </div>

                            <div class="Valider">
                                <input style="background: #6E85B2;margin-top: 10%;width: 150px;border: 1px solid black"
                                       type="submit" name="submit" value="Ajouter"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div  class="card mb-4">
                        <div class="barre"></div>
                        <br>
                        <!--TABLEAU-->
                        <h2 class="text-center" style="padding:15px" ;>Vos disponibilités</h2>

                        <div class="table-responsive">
                            <?php
                            $etreDispo  = "SELECT idUser,intitule,dateDeb,dateFin FROM cours,etreDispo where cours.idCours=etreDispo.idCours AND idUser = $user->idUser";
                            $etreDispo = $conn->prepare($etreDispo);
                            $etreDispo->execute();
                            if (isset($_POST['submit'])) {
                                $user = $_POST['idUser'];
                                $cours = $_POST['idCours'];
                                $idVille = $_POST['idVille'];
//                                $niveau = $_POST['niveau'];
                                $Motivation = $_POST['motivation'];
                                $dateDeb = $_POST['dateDeb'];
                                $dateFin = $_POST['dateFin'];
                                $typeDispo = $_POST['typeDispo'];
                                $enDuo = $_POST['enDuo'];


                                $sql = $conn->prepare("INSERT INTO etreDispo (idUser,idCours,idVille,dateDeb,dateFin ,typeDispo,enDuo,Motivation) VALUES (:user,:cours,:idVille,:dateDeb,:dateFin,:typeDispo,:enDuo,:motivation)");
                                $sql->bindParam(':user', $user);
                                $sql->bindParam(':cours', $cours);
                                $sql->bindParam(':idVille', $idVille);
                                $sql->bindParam(':motivation', $Motivation);
                                $sql->bindParam(':dateDeb', $dateDeb);
                                $sql->bindParam(':dateFin', $dateFin);
                                $sql->bindParam(':typeDispo', $typeDispo);
                                $sql->bindParam(':enDuo', $enDuo);
                                $sql->execute();


                            }
                            ?>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>idUser</th>
                                    <th>Cours</th>
                                    <th>dateDeb</th>
                                    <th>dateFin</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                while ($row = $etreDispo->fetch() ) {
                                    echo "<tr>";
                                    echo "<td>" . $row['idUser'] . "</td>";
                                    echo "<td>" . $row['intitule'] . "</td>";
                                    echo "<td>" . $row['dateDeb'] . "</td>";
                                    echo "<td>" . $row['dateFin'] . "</td>";
                                    echo "</tr>";

                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </br>

                </div>
        </form>
    </div>

    </div>
</section>
</body>
</html>

<?php
include_once __DIR__ . '/View/footer_index.php';
?>
