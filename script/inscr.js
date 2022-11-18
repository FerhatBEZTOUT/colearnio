$(document).ready(function () {



    $('#inputPseudo').keyup(function () {
        var pseudo = $('#inputPseudo').val();
        if (pseudo != "") {
            $.post('pseudo.php', { pseudo: pseudo }, function (data) {
                console.log(data);
                if (data == 'dispo') {
                    console.log("dispo");
                    $('#feedbackdispo').removeClass("invisible");
                    $('#feedbacknodispo').addClass("invisible");
                } else {
                    console.log("no dispo");
                    $('#feedbacknodispo').removeClass("invisible");
                    $('#feedbackdispo').addClass("invisible");
                }

            });
        } else {
            console.log("aucune des deux");
            $('#feedbackdispo').addClass("invisible");
            $('#feedbacknodispo').addClass("invisible");
        }

    })


    $("#formInscr").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "../AJAX/inscription.php",
            data: $(this).serialize(),
            success: function (response) {
                if (response != '') {
                    
                    if (response == 'invalid_captcha') {
                        $("#error").text("Captcha invalide, réessayez");
                    }
                    else {
                        r = JSON.parse(response);
                        err = false;
                        
                        for(var keyvalue in r ){
                            
                            if (value==0) {
                                err = true;
                                break;
                            }
                        }
                    }
                } else {

                }
            }
        });
    })
});

