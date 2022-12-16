

<?php
if(!session_id()) {
    session_start();
}

include_once __DIR__."/Controller/redirect.php";
redirectFromLanding();

$titre = "Colearnio - Apprendre ensemble";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/inscr.css">
    <link rel="stylesheet" href="../css/landing.css">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
   
    <title><?= $titre?></title>
</head>

<body class="vh-100" style="display:flex;
    min-height:100vh;
    flex-direction: column;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light nav">
        <a class="navbar-brand d-flex mx-auto justify-content-center logo" href="../"><img src="../img/logo.png" alt="Logo" style="width: 80%;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse px-4" id="navbarNavAltMarkup">
            <div class="navbar-nav ">
                <a class="nav-item nav-link" href="../connexion.php">Connexion</a>
                <a class="nav-item nav-link" href="../inscription.php">Inscription</a>
                
                <a class="nav-item nav-link" href="../about-us.php">Qui sommes nous</a>
                
            </div>
        </div>
    </nav>
<!-- Fin Header -->

<section id="accueil" style="background: linear-gradient(rgba(0,0,0,0.5),#6E85B2),url(/photo/etudiants.jpg);">
    
    <div class="text">
        <h1> COLEARNIO, APPRENDRE ENSEMBLE.</h1>
        <div class="btn">
            <a href="connexion.php"><span></span> Connexion</a>
            <a href="inscription.php"><span></span> Inscription</a>
        </div>
    </div>
</section>

<section id="milieu">
    <div class="mil">
        <p>CoLearnio</p>
        <h2>CoLearnio vous permet de trouver des partenaires pour réviser vos cours, partager vos
            connaissances, compétences et astuces.</h2>
    </div>

    <div class="image">
        <div class="im1">
            <h2>Restez en contact</h2>
            <div class="im1-desc">
                <p>Trouvez des personnes avec qui vous vous partegerez vos connaissances et restez en contact</p>
            </div>
        </div>
        <div class="img1">
            <img src="img/photo1.webp" alt="chat application">
        </div>
        <div class="im2">
            <h2>Devant chez vous</h2>
            <div class="im2-desc">
                <p>Trouvez les personnes les plus proches de vous et qui ont les mêmes intérêts que vous afin que vous puissiez réviser ensembles.</p>
            </div>
        </div>
        <div class="img2">
            <img src="img/photo2.webp" alt="geolocalisation">
        </div>
    </div>
</section>

<!-- commentaire-->
<section id="message">
    <div class="mil">
        <p>CoLearnio</p>
        <h2>AVIS</h2>
    </div>
    <div class="name">
        <div class="-col">
            <div class="utilisateur">
                <img src="img/user.jpg" alt="avatar d'un utilisateur">
                <div class="info">
                    <h4>Anna Emy <i class="fa fa-instagram"></i></h4>

                </div>
            </div>
            <p>le site est super bien il m'a beaucoup aidé, j'ai validé ma L1 grâce à l'aide des autres membres</p>
        </div>
        <div class="-col">
            <div class="utilisateur">
                <img src="img/utilisateur.png" alt="avatar d'un utilisateur">
                <div class="info">
                    <h4>David dermani <i class="fa fa-twitter"></i></h4>

                </div>
            </div>
            <p>J'adore ce site, à quand la version mobile et surtout sur iOS ???</p>
        </div>
    </div>

</section>






<!--footer-->
<section id="footer">
    <div class="mil">
        <p>Contact</p>
    </div>
    <div class="row">
        <div class="left">
            <h2>COLEARNIO</h2>
            <P>Apprendre ensemble.</P>
        </div>
        <div class="right">
            <h2>Contact</h2>
            <P> 2 Av. Adolphe Chauvin,
                95300 Pontoise <i class="fa fa-paper-plane"></i></P>

            <P>01 23 45 67 89 <i class="fa fa-phone"></i></P>
        </div>
    </div>
    <div class="Rsociaux">
        <a href="https://facebook.com/fonusrax" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="https://instagram.com/colearnio" target="_blank"><i class="fa fa-instagram"></i></a>
        <a href="https://twitter.com/ferhatbeztout" target="_blank"><i class="fa fa-twitter"></i></a>
    </div>
</section>


</body>

</html>
