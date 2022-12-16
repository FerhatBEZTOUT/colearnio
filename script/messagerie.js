$(document).ready(function () {

    const exampleModal = document.getElementById('exampleModal')

    exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('.modal-body input')


    })


$("#checkBoxDisc").change(function (e) { 
    $("btn-checkbox").click();
});






$("#btnCreateRoom").click(function (e) { 
    e.preventDefault();
    chatRoomName = $("#chatRoomName").val();
    descRoom = $("#descRoom").val();
    $.ajax({
        type: "POST",
        url: "../AJAX/createChatRoom.php",
        data: {chatRoomName : chatRoomName , descRoom : descRoom},
        
        success: function (response) {
            if (response!='') {
                if (response=='ROOM_CREATED') {
                    console.log("created room");
                    $("#errorCreateRoom").addClass("invisible");
                    $("#chatRoomName").val("");
                    $("#descRoom").val("");
                    $("#closeCreateRoom").click();
                } else 
                if (response=='EMPTY_INPUT') {
                    console.log("empty input room");
                    $("#errorCreateRoom").text("Les champs doivent être complets");
                    $("#errorCreateRoom").removeClass("invisible");
                } else 
                if (response=='PROBLEM_CREATION_ROOM') {
                    console.log("problem create room");
                    $("#errorCreateRoom").text("Probléme lors de la création de la conversation");
                    $("#errorCreateRoom").removeClass("invisible");
                }  
            } else {
                $("#errorCreateRoom").text("Pas de réponse du serveur, veuillez réessayez");
                $("#errorCreateRoom").removeClass("invisible");
            }
        }
    });
});

    



})