<?php
if (!session_id()) {
    session_start();
}

include_once __DIR__ . '/Model/connexionBD.php';
include __DIR__ . '/query/user.php';


$conn = newConnect();
//$user = getUserById(3);


$user = $_SESSION['user'];

$query = "SELECT niveau,ville FROM utilisateur where  idUser = ?";
$query = $conn->prepare($query);
$query->execute(array($_SESSION['user']->idUser));
//$for = $query->fetch(PDO::FETCH_OBJ);
//var_dump($for);
$titre = "Colearnio - Profil";
include_once __DIR__ . '/View/header_monespace.php';
?>

<section>
    <div class="container py-5">

        <div class="row">
            <div class="col">
                <h1 aria-label="breadcrumb" class="titre rounded-3 p-3 mb-4">Ajouter une disponibilité</h1>
            </div>
        </div>

        <form method="POST" action="">
            <div class="row container">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">






                                    <!-- ---------------------- Ville ------------------ -->
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="idVille">Ville</label>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <select class="form-select" name="idVille" id="idVille">
                                        <option value="0" <?php if (!$_SESSION['user']->ville) echo ' selected '; ?>>Sélectionner une ville</option>
                                        <?php
                                        $villes = getVilles();

                                        if ($villes) {
                                            foreach ($villes as $ville) {
                                                echo '<option value="' . $ville->idVille . '"';
                                                if ($ville->idVille == $_SESSION['user']->ville) echo ' selected';
                                                echo '>' . $ville->nom_ville . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>






                                <!-- ---------------------- Cours ------------------ -->
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="idCours">Cours</label>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    
                                    <select class="form-select" name="idCours" id="idCours">
                                        <option selected value="0">Selectionner un cours</option>
                                        <?php
                                        $sql = "SELECT * FROM cours";
                                        $result = $conn->query($sql);
                                        if ($result->rowCount() > 0) {
                                            while ($row = $result->fetch()) {
                                                echo "<option value='" . $row['idCours'] . "'>" . $row['intitule'] . "</option>";
                                            }
                                        }
                                        ?>


                                    </select>
                                </div>
                            </div>

                            


                                <!-- ---------------------- Motivation ------------------ -->
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="motivation">Motivation</label>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                        <textarea class="form-control" name="motivation" id="motivation" cols="auto " rows="2"></textarea>
                                </div>
                            </div>




                               <!-- ---------------------- Date début ---------------------- -->
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-4">
                                <label for="DateDeb">Date début</label>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <input class="form-control" type="date" id="dateDeb" name="dateDeb">
                                </div>
                            </div>





                                <!-- ---------------------- Date Fin ---------------------- -->
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-4">
                                <label for="dateFin">Date fin</label> 
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <input class="form-control" type="date" id="dateFin" name="dateFin">
                                </div>
                            </div>







                              <!-- ---------------------- Type dispo ---------------------- -->
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-4">
                                <label for="typeDispo">Type disponibilité</label> 
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <select  class="form-select" name="typeDispo" id="typeDispo">
                                        <option selected value="null">Selectionner un type</option>
                                        <option value="presentiel">Presentiel</option>
                                        <option value="distanciel">Distanciel</option>
                                        <option value="both">Les deux</option>
                                    </select>
                                </div>
                            </div>


                                <!-- ---------------------- check box "En duo" ---------------------- -->
                            <div class="row mb-2">
                            <div class="col-sm-12 col-lg-4">
                                <label for="duo">Duo</label> 
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <input type="checkbox" id="duo" name="enDuo" style="width: 20px; height: 20px;" value="0">
                                </div>
                            </div>





                            <div class="text-center">
                                <input class="btn btn-primary" type="submit" name="submit" value="Ajouter">
                            </div>

                           
                        </div>
                    </div>
                </div>









                <div class="col-lg-8">
                    <div class="card mb-4">
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
                                $user = $user->idUser;
                                $cours = $_POST['idCours'];
                                $idVille = $_POST['idVille'];
                                //                                $niveau = $_POST['niveau'];
                                $Motivation = $_POST['motivation'];
                                $dateDeb = $_POST['dateDeb'];
                                $dateFin = $_POST['dateFin'];
                                $typeDispo = $_POST['typeDispo'];
                                if (!isset($_POST['enDuo'])) {
                                    $enDuo = false;
                                } else {
                                    $enDuo = $_POST['enDuo'];
                                }
                                


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

                                        <th>Cours</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <!-- <th>Action</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    while ($row = $etreDispo->fetch()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['intitule'] . "</td>";
                                        echo "<td>" . $row['dateDeb'] . "</td>";
                                        echo "<td>" . $row['dateFin'] . "</td>";

                                        //     echo '<td>
                                        //     <a href="delCours.php?idUser=' . $row['idUser'] . '&dateDeb=' . $empr->id_adh . '&dateEmpr=' . $empr->date_emp . '"  target="_blank"><button class="btn btn-outline-danger">Annuler</button></a>
                                        //     <a href=\"ret_emp.php?idExemp=' . $empr->id_exemp . '&idAdh=' . $empr->id_adh . '&dateEmpr=' . $empr->date_emp . '"  target="_blank"><button class="btn btn-outline-success">Rendu</button></a>
                                        // </td>';

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