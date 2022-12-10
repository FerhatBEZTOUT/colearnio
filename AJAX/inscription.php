<?php
include_once __DIR__.'/../Model/connexionBD.php';
include_once __DIR__.'/../query/user.php';
include_once __DIR__.'/../Controller/sendMail.php';
include_once __DIR__.'/../Controller/VerifyEmail.class.php';
/**
 * CheckCaptcha
 * Fonction qui vérifie le captcha fourni par Google
 * @param  mixed $userResponse 
 * @return void
 */
function CheckCaptcha($userResponse) {
    $fields_string = '';
    $fields = array(
        'secret' => '6LdlCgkjAAAAAO31QpmlgcUnBXRdyn_sPXmKCbpf', // Clé privée du captcha
        'response' => $userResponse
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $res = curl_exec($ch);
    curl_close($ch);

    return json_decode($res, true);
}


if (isset($_POST['g-recaptcha-response'])){
$result = CheckCaptcha($_POST['g-recaptcha-response']);
if ($result['success']) {
    
    if(isset($_POST['nom'],$_POST['prenom'] ,$_POST['pseudo'], $_POST['email'], $_POST['mdp'] ,$_POST['confmdp'])){
        // Tableau pour stocker les erreurs 
        // 0 = pas d'erreur
        // 1 = champ incorrect
        // 2 = champ vide
        // 3 = reservé pour mail inexistant ou invalide
        $err['nom'] = 0;
        $err['prenom']=0;
        $err['pseudo']=0;
        $err['email']=0;
        $err['mdp']=0;
        $err['confmdp']=0;

        if (!empty($_POST['nom']) &&
            !empty($_POST['prenom']) &&
            !empty($_POST['pseudo']) &&
            !empty($_POST['email']) &&
            !empty($_POST['mdp']) &&
            !empty($_POST['confmdp'])){
                $nom = htmlentities($_POST['nom']);
                $prenom = htmlentities($_POST['prenom']);
                $pseudo = htmlentities($_POST['pseudo']);
                $email = htmlentities($_POST['email']);
                $mdp = htmlentities($_POST['mdp']);
                $confmdp = htmlentities($_POST['confmdp']);

                if(!ctype_alpha($nom)) $err['nom']=1;
                if(!ctype_alpha($prenom)) $err['prenom']=1;
                if(!preg_match('/^[A-Za-z0-9_-]{3,20}$/s',$pseudo)) $err['pseudo']=1;
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))  $err['email']=1;
                if(preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $mdp)) {
                    if($mdp!=$confmdp) { $err['mdp']=1; $err['confmdp']=1;
                    }
                 } else {
                    
                    $err['mdp']=1;
                }

                $error = false;
                foreach($err as $key => $value){
                    if ($value==1) {
                        $error = true;
                        break;
                    }
                }
                
                if($error) {
                    echo json_encode($err);
                } else {
                    $existEmail = existEmail($email);
                        if ($existEmail[0]) {
                            echo "EXIST_EMAIL";
                        } else {
                            $existPseudo = existPseudo($pseudo);
                            if ($existPseudo[0]) {
                                echo "EXIST_PSEUDO";
                            } else {
                                if(verifierEmail($email)=='valid not exist' || verifierEmail($email)=='not valid not exist') {
                                    $err['email']=3;
                                    echo json_encode($err);
                                } else {
                                    $hashmdp = password_hash($mdp, PASSWORD_DEFAULT);
                                    $key = password_hash($nom.date("Y-m-d H:i:s"),PASSWORD_DEFAULT);
                                    inscrire($nom,$prenom,$pseudo,$email,$hashmdp,$key);
                                    envoyerMail($email,$nom,$prenom,$key);
                                    echo 'INSCR_OK';
                                }
                            }
                            
                        }
                    
                    

                }
                
        } 
        else {
            

            if(empty($_POST['nom']))        $err['nom']=2;
            if(empty($_POST['prenom']))     $err['prenom']=2;
            if(empty($_POST['pseudo']))     $err['pseudo']=2;
            if(empty($_POST['email']))      $err['email']=2;
            if(empty($_POST['mdp'])) {
                $err['mdp']=2;
            } else {
                if(preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',htmlentities( $_POST['mdp']))) {
                    if(htmlentities($_POST['mdp'])!=htmlentities($_POST['confmdp'])) { $err['confmdp']=1;
                    }
                 } else {
                    
                    $err['mdp']=1;
                }
            }        
                
            if(empty($_POST['confmdp'])) {
                $err['confmdp']=2;
            } else {
                if(htmlentities($_POST['mdp'])!=htmlentities($_POST['confmdp'])) { $err['confmdp']=1;
                }
            }    
           

            echo json_encode($err);
            }
        }
        
}
else {
    echo 'invalid_captcha';
}
} else {
    echo 'remplir_captcha';
}

