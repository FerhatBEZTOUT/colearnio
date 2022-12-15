<?php

function isUser() {
    if (isset($_SESSION['userType'])) {
        if( $_SESSION['userType']!='admin') {
            header('location:http:\\');
            exit();
        }
    }
}


?>