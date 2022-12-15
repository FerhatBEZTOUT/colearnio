<?php

include_once __DIR__."/../config.ini.php";
function newConnect() {
    $conn = NULL;
    GLOBAL $host,$dbname,$user,$password;

    try {

        // objet PDO qui permet de faire des requete vers la BD
        $conn = new PDO('mysql:host='. $host.';dbname='.$dbname.'',$user,$password);
    } catch (PDOException $e) {
        echo 'Impossible de se connecter à la BDD : '.$e->getMessage();

    }

    return $conn;
}

$conn = newConnect();

//handle incoming messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = $_POST['sender'];
    $message = $_POST['message'];
    $receiver = $_POST['receiver'];

    $sql =$conn->prepare( "INSERT INTO messages (sender, message, receiver) VALUES ('$sender', '$message', '$receiver')");
    $result = execute();

}

//recevoire les dernier messagde ma database
//$sql = "SELECT * FROM messages ORDER BY timestamp DESC LIMIT 10";
//$result = mysqli_query($conn, $sql);
//
////on format pour html
//$messages = "";
//while ($row = mysqli_fetch_assoc($result)) {
//    $messages .= "<div class='message'>
//        <span class='sender'>" . $row["sender"] . "</span>
//        <span class='message'>" . $row["message"] . "</span>
//        </div>";
//}
//echo $messages;

$result = $conn->query('SELECT * FROM chat ORDER BY timestamp ASC');
$messages = [];

//on format pour html
while ( $row = $result->fetch() ) {
    $messages[] = $row;
}

// Return the messages as a JSON-encoded array
echo json_encode($messages);