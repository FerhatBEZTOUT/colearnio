<?php 
    include_once __DIR__.'/../Model/connexionBD.php';


function getMessagesOfChatRoom($idChatRoom){
    try {
        $conn = newConnect();
        $query = $conn->prepare("SELECT * FROM envoyerMsg M JOIN 
        utilisateur U ON M.idUser=U.idUser
        WHERE idChatRoom=?  ORDER BY dateEnvoi LIMIT 20");
        $query->execute(array($idChatRoom));
        $resultat = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $resultat;
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }



    
}






function getUserOFRooms($idChatRoom){
    try {
        $conn = newConnect();
        $query = $conn->prepare("SELECT * FROM ChatRoomUsers M JOIN 
        utilisateur U ON M.idUser=U.idUser
        WHERE idChatRoom=?");
        $query->execute(array($idChatRoom));
        $resultat = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $resultat;
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}


function isUserInRoom($idUser, $idChatRoom) {
    try {
        $conn = newConnect();
        $query = $conn->prepare("+-CT COUNT(*) FROM ChatRoomUsers M JOIN 
        utilisateur U ON M.idUser=U.idUser
        WHERE idChatRoom=? AND M.   idUser=?");
        $query->execute(array($idChatRoom,$idUser));
        $resultat = $query->fetch(PDO::FETCH_OBJ); 
        
        return $resultat;
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function envoyerMsg($msg,$idUser,$idRoom) {

}

    ?>