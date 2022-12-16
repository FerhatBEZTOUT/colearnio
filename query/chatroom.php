<?php
    include_once __DIR__.'/../Model/connexionBD.php';
    
    

    function createChatRoom(string $roomName,string $desc,string $iduser) {
          
        $conn = newConnect();
        $q = $conn->prepare('INSERT INTO chatRoom(nomCR,descCR,dateCreaCR,idUser)
        VALUES (?,?,?,?)');
        $r = $q->execute(array($roomName,$desc,date("Y-m-d H:i:s"),$iduser));

        return $r;
 }



    function getProperChatRoomUser($idUser,$idChatRoom){

        try {
            $conn = newConnect();
            $query = $conn->prepare("SELECT * 
            FROM chatRoom C 
            JOIN utilisateur U
            ON U.idUser=C.idUser 
            WHERE C.idUser=? AND idChatRoom=?");
            $query->execute(array($idUser,$idChatRoom));
            $resultat = $query->fetch(PDO::FETCH_OBJ); 
            
            return $resultat;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    function getChatRoomUser($idUser){
        try {
            $conn = newConnect();
            $query = $conn->prepare("SELECT C.* FROM ChatRoomUsers CU JOIN 
            chatRoom C ON C.idChatRoom=CU.idChatRoom
            WHERE CU.idUser=?");
            $query->execute(array($idUser));
            $resultat = $query->fetchAll(PDO::FETCH_OBJ); 
            
            return $resultat;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    function getCreatedRoomsOfUser($idUser){
        try {
            $conn = newConnect();
            $query = $conn->prepare("SELECT * FROM chatRoom WHERE idUser=?");
            $query->execute(array($idUser));
            $resultat = $query->fetchAll(PDO::FETCH_OBJ); 
            
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