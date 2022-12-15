<?php
if(!session_id()){
    session_start();
}
    if(isset($_POST['chatRoomName'],$_POST['descRoom'])){
        if (!empty($_POST['chatRoomName']) && !empty($_POST['descRoom'])) {
            $chatRoomName = $_POST['chatRoomName'];
            $descRoom = $_POST['descRoom'];

            $idUser = $_SESSION['user']->idUser;
            include_once __DIR__.'/../query/chatroom.php';
            if (createChatRoom($chatRoomName,$descRoom,$idUser)) {
                echo 'ROOM_CREATED';
            } else {
                echo 'PROBLEM_CREATION_ROOM';
            }
        } else {
            echo 'EMPTY_INPUT';
        }
    }

?>