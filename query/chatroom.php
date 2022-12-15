<?php
    include_once __DIR__.'/../Model/connexionBD.php';
    
    

    function createChatRoom(string $roomName,string $desc,string $iduser) {
          
        $conn = newConnect();
        $q = $conn->prepare('INSERT INTO chatRoom(nomCR,descCR,dateCreaCR,idUser)
        VALUES (?,?,?,?)');
        $r = $q->execute(array($roomName,$desc,date("Y-m-d H:i:s"),$iduser));

        return $r;
 }



    function getProperChatRoomUser($idUser){

        try {
            $conn = newConnect();
            $query = $conn->prepare("SELECT * FROM chatRoom WHERE idUser=?");
            $query->execute(array($idUser));
            $resultat = $query->fetch(PDO::FETCH_OBJ); 
            
            return $resultat;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    function getChatRoomUser($idUser){
        try {
            $conn = newConnect();
            $query = $conn->prepare("SELECT C.* FROM chatRoomUsers CU JOIN 
            chatRoom C ON C.idChatRoom=CU.idChatRoom
            WHERE idUser=?");
            $query->execute(array($idUser));
            $resultat = $query->fetch(PDO::FETCH_OBJ); 
            
            return $resultat;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    function getUsersOfChatRoom($idChatRoom) {
        try {
            $conn = newConnect();
            $query = $conn->prepare("SELECT DISTINCT U.* FROM utilisateur U
            JOIN chatRoomUsers CU ON U.idUser=CU.idUser");
            $query->execute(array($idChatRoom));
            $resultat = $query->fetch(PDO::FETCH_OBJ); 
            
            return $resultat;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



?>