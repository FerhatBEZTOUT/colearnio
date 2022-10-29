<?php

if ( isset($_GET['key'])) {
    $key = $_GET['key'];
    $key = md5(date('h:i:sa'));
    echo '<h1>Page validation de compte pas encore finie</h1>';
    echo '<p>clé validation : <b>'.$key.'</b></p>';
}

?>