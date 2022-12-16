
$( document ).ready(function() {
    
    $("#connexionForm").submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../AJAX/login.php",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                if (response=='admin') {
                    window.location.href = '../dashboard.php';
                }
                else if (response=='user') {
                    window.location.href = '../partenaire.php';  // à modifier "partenaire.php"
                } else if (response=='NOT FOUND') {
                    $("#error").html("Email ou mot de passe incorrect");
                    $("#error").removeClass("invisible");
                    $("#error").effect("shake");
                   
                } else if (response=='NOT SET') {
                    $("#error").html("Champs incomplets");
                    $("#error").removeClass("invisible");
                    $("#error").effect("shake");
                } else if (response=='EMPTY') {
                    $("#error").html("Champs incomplets");
                    $("#error").removeClass("invisible");
                    $("#error").effect("shake");
                } else {
                    $("#error").html('Email non confirmé. <a href="renvoyer_mail.php?email='+response+'">Renvoyer l\'email de confirmation</a>');
                    $("#error").removeClass("invisible");
                    $("#error").effect("shake");
                    
                }
            }
        });
    });


















});