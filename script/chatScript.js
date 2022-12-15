// setInterval(function() {
//     var xhttp= new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("chat-display").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "chat.php", true);
//     xhttp.send();
// },3000);
//
// document.getElementById("chat-form").addEventListener("submit", function(e) {
//
//     e.preventDefault();
//
//     var xhttp= new XMLHttpRequest();
//     xhttp.open("POST", "../chat.php", true);
//     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhttp.send("sender="+this.sender.value+"&message="+this.message.value);
//     this.message.value = "";
//     this.sender.value = "";
// });
// Set up the Fetch API to retrieve messages from the PHP script
const url = '../Controller/chatHandler.php';

// Set up a function to update the chat messages
function updateMessages() {
    // Retrieve the messages from the PHP script
    fetch(url)
        .then(response => response.json())
        .then(messages => {
            // Clear the existing messages
            const messageList = document.querySelector('#messages');
            messageList.innerHTML = '';

            // Add each message to the list
            for (const message of messages) {
                const li = document.createElement('li');
                li.innerHTML = `<b>${message.sender}</b>: ${message.message}`;

                messageList.appendChild(li);
            }

            // Scroll to the bottom of the message list
            messageList.scrollTop = messageList.scrollHeight;
        });
}

// Set up an event listener to handle form submissions
const messageForm = document.querySelector('#message-form');
messageForm.addEventListener('submit', e => {
    // Prevent the form from actually submitting
    e.preventDefault();

    // Read the message text and sender name from the form
    const message = document.querySelector('#message').value;
    const sender = document.querySelector('#sender').value;
    const receiver=document.querySelector('#receiver').value;
    // Use the Fetch API to send the message to the PHP script
    fetch(url, {
        method: 'POST',
        body: JSON.stringify({
            sender: sender,
            message: message,
            receiver:receiver

        })
    });

    // Clear the form and update the chat messages
    messageForm.reset();
    updateMessages();
});

// Update the chat messages every 1 second
setInterval(updateMessages, 5000);
