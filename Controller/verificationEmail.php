<?php
include_once __DIR__.'/VerifyEmail.class.php';

 if(isset($_GET['email'])) {
     verifierEmail($_GET['email']);
 }

?>