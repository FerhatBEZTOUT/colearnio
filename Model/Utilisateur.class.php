<?php 
    
    /**
     * Utilisateur
     * 
     * Classe pour pouvoir récupérer/modifier les données de l'utilisateur
     */
    class Utilisateur {
       private $idUser;
       private $nom;
       private $prenom;
       private $dateNaiss;
       private $pseudo;
       private $rue;
       private $codePost;
       private $ville;
       private $email;
       private $mdp;
       private $isValidMail;
       private $cle;
       private $niveau;
       private $dateTimeInscri;
       private $isAdmin;

       function __construct()
       {
        $this->idUser=NULL;
        $this->nom=NULL;
        $this->prenom=NULL;
        $this->dateNaiss=NULL;
        $this->pseudo=NULL;
        $this->rue=NULL;
        $this->codePost=NULL;
        $this->ville=NULL;
        $this->email=NULL;
        $this->mdp=NULL;
        $this->isValidMail=NULL;
        $this->cle=NULL;
        $this->niveau=NULL;
        $this->dateTimeInscri=NULL;
        $this->isAdmin=false;
       }


       /**
        * Get the value of idUser
        */ 
       public function getIdUser()
       {
              return $this->idUser;
       }

       /**
        * Get the value of nom
        */ 
       public function getNom()
       {
              return $this->nom;
       }

       /**
        * Get the value of prenom
        */ 
       public function getPrenom()
       {
              return $this->prenom;
       }

       /**
        * Get the value of dateNaiss
        */ 
       public function getDateNaiss()
       {
              return $this->dateNaiss;
       }

       /**
        * Get the value of pseudo
        */ 
        public function getPseudo()
        {
               return $this->pseudo;
        }

       /**
        * Get the value of rue
        */ 
       public function getRue()
       {
              return $this->rue;
       }

       /**
        * Get the value of codePost
        */ 
       public function getCodePost()
       {
              return $this->codePost;
       }

       /**
        * Get the value of ville
        */ 
       public function getVille()
       {
              return $this->ville;
       }

       /**
        * Get the value of email
        */ 
       public function getEmail()
       {
              return $this->email;
       }

       /**
        * Get the value of mdp
        */ 
       public function getMdp()
       {
              return $this->mdp;
       }

       /**
        * Get the value of isValidMail
        */ 
       public function getIsValidMail()
       {
              return $this->isValidMail;
       }

       /**
        * Get the value of cle
        */ 
       public function getCle()
       {
              return $this->cle;
       }

       

       /**
        * Get the value of niveau
        */ 
       public function getNiveau()
       {
              return $this->niveau;
       }

       /**
        * Get the value of dateTimeInscri
        */ 
        public function getDateTimeInscri()
        {
               return $this->dateTimeInscri;
        }

       /**
        * Get the value of isAdmin
        */ 
       public function getIsAdmin()
       {    
              return $this->isAdmin;
       }

       
       public function getUserById($id){
        include_once 'connexionBD.php';
        $conn = newConnect();
        try {

            $query = $conn->prepare("SELECT * FROM utilisateur WHERE id=?");
            $query->execute(array($id));
            $r = $query->fetch(PDO::FETCH_OBJ); // $r = resultat

            $this->idUser=$r->idUser;
            $this->nom=$r->nom;
            $this->prenom=$r->prenom;
            $this->dateNaiss=$r->dateNaiss;
            $this->pseudo=$r->pseudo;
            $this->rue=$r->rue;
            $this->codePost=$r->codePost;
            $this->ville=$r->ville;
            $this->email=$r->email;
            $this->mdp=$r->mdp;
            $this->isValidMail=$r->isValidMail;
            $this->cle=$r->cle;
            $this->idFormation=$r->idFormation;
            $this->niveau=$r->niveau;
            $this->dateTimeInscri=$r->dateTimeInscri;;
            $this->isAdmin=$r->isAdmin;

        } catch (PDOException $e) {
            echo $e->getMessage();
        } 
        
        
        
       }

       
    }

    

?>