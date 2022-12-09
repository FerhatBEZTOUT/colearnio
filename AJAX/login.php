<?php

if(isset($_POST['email']) && isset($_POST['mdp'])) {

    if(empty($_POST['email']) || empty($_POST['mdp'])) {
      echo 'EMPTY';
        
    } 
    else {
      $email = htmlentities($_POST['email']);
      $mdp = htmlentities($_POST['mdp']);

      include_once __DIR__.'/../query/user.php';
      
      $user = getUserByEmail($email);   // User == FALSE la fonction n'a trouvé aucun email
      
      if ($user) {
          if (password_verify($mdp,$user->mdp)) {
            if(!session_id()) {
              session_start();
            }
            if ($user->isValidMail) {
              
              $_SESSION['connecté']=1;
              $_SESSION['user']=$user;
              
              if($user->isAdmin) {
                echo 'admin';
              } else {
                echo 'user';
              }
            } else {
              echo $email;
            }
           
          } else {
            echo 'NOT FOUND';
          }
      } 
      else {
          echo 'NOT FOUND';
      }
      
    }
  } 
  else {
    echo 'NOT SET';
  }

?>