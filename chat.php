<?php

$titre = "Colearnio - Chat";
include_once __DIR__ . '/View/header_monespace.php';


include_once __DIR__ . '/query/chat.php';
// if (isset($_GET['room'])) {
//     $idroom = htmlentities($_GET['room']);
//     var_dump(isUserInRoom($_SESSION['user']->idUser, $idroom));
//     if (isUserInRoom($_SESSION['user']->idUser, $idroom)) {

//         header("location:messagerie.php");
//     }
// }


?>

<style>
    img {
        width: 45px;
        border-radius: 50%;
    }
</style>
<div class="container mt-3 border border-secondary " style="height: 100%;">
    <div class="row p-3">
        <div class="row col-sm-0 d-none d-lg-block col-lg-4 border border-secondary me-3">
            <ul class="list-unstyled mt-2">
                <?php

                if (isset($_GET['room'])) {

                    $users = getUserOFRooms($_GET['room']);

                    foreach ($users as $user) {
                        echo '<li class="clearfix active"> <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar" style=" width: 45px;
                    border-radius: 50%;">
                                <div class="about">
                                    <div class="name">' . $user->nom . ' ' . $user->prenom . '</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> En ligne</div>
                                </div>
                            </li>';
                    }



                ?>




            </ul>

        </div>
        <div class="row col-sm-12 col-lg-8 border border-secondary" style="overflow-x: auto;">

            <ul class="list-unstyled mt-2">

            <?php

                    $msgs = getMessagesOfChatRoom($_GET['room']);

                    foreach ($msgs as $msg) {
                        echo '<li class="clearfix">
                            <div class="message-data text-right"> <span class="message-data-time">' . $msg->dateEnvoi . '</span> <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"></div>
                            <div class="message other-message float-right">' . $msg->msg . '</div>
                        </li>';
                    }
                }
            ?>

            </ul>
            <form action="" method="POST" name="formMsg">
                <input class="form-contorl" type="text" name="msg" style="border-style:solid;">
                <button type="button" class="btn btn-primary" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"></path>
                    </svg>
                </button>
            </form>

        </div>


    </div>


</div>

<?php
include_once __DIR__ . '/View/footer_index.php';
?>