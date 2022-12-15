<?php
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/chatstyle.css">
    <title>colearnio</title>
</head>
<body>

    <h1>Instant Chat</h1>

    <form id="message-form">
        <label for="sender">Your Name:</label>
        <input id="sender" type="text" placeholder="Enter your name">
        <label for="receiver">his name</label>
        <input id="receiver" type="text" placeholder="Enter his name">
        <label for="message">Message:</label>
        <textarea id="message" placeholder="Enter your message"></textarea>

        <button type="submit">Send Message</button>
    </form>

    <ul id="messages"></ul>
    </from>







<!-- <div id="chat">
     <div id="messages"></div>
     <div id="sender">
         <input type="text" id="senderName" placeholder="Your name">
         <input type="text" id="message" placeholder="Your message">
         <input type="text" id="receiverName" placeholder="receiver name">
         <button id="send">Send</button>
     </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
     $(document).ready(function () {
         //get messages
         function getMessages() {
             $.ajax({
                 url: "chat.php",
                 type: "GET",
                 success: function (data) {
                     $("#messages").html(data);
                 }
             });
         }
         getMessages();
         setInterval(getMessages, 1000);
         //send messages
         $("#send").click(function () {
             var sender = $("#senderName").val();
             var message = $("#message").val();
             var receiver = $("#receiverName").val();
             $.ajax({
                 url: "chat.php",
                 type: "POST",
                 data: {
                     sender: sender,
                     message: message,
                     receiver: receiver
                 },
                 success: function (data) {
                     getMessages();
                 }
             });
         });
     });
 </script>-->
<script src="script/chatScript.js"></script>
</body>
</html>