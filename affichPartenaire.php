<?php
function affichPart($pseudo,$formation,$motivation,$user){
    echo "
        <div class=\"col-lg-4\">
            <div class=\"card partenaire-container\">
                <div class=\"row partenaire\">
                    <div class=\"col-sm-8\" style=\"margin: auto;\";>
                        <img src=\"img/user.jpg\" alt=\"avatar\" class=\"rounded-circle img-fluid\" style=\"width: 100%; margin-left: 5px; margin-top:5px;\">
                    </div>
                    <div class=\"col-sm-12\" style=\"text-align:center\";>
                        <h5>$pseudo</h5>
                        <p>$formation</p>
                        <p>$motivation</p>
                    </div>
                    <div class=\"buttons\">
                        <a href=\"#\" class=\"btn btn-outline-primary ms-1\">Contacter</a>
                        <a href=\"profileAutre.php?iduser=$user\" class=\"btn btn-outline-primary ms-1\">Voir profil</a>
                    </div>
                </div>
            </div>
        </div>
    ";
}

?>