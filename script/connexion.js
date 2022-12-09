
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
                    window.location.href = '../partenaire.php';
                } else if (response=='NOT FOUND') {
                    $("#error").html("Email ou mot de passe incorrect");
                    $("#error").removeClass("invisible");
                    $("#error").effect("shake");
                   
                } else if (response=='NOT SET') {
                    $("#error").html("Champs incomplets");
                    $("#error").removeClass("invisible");
                    $("#error").effect("shake");
                } else {
                    $("#error").html("Email non confirmé. Renvoyer le mail de confirmation"+response);
                    $("#error").removeClass("invisible");
                    $("#error").effect("shake");
                    
                }
            }
        });
    });


















});