$(document).ready(function () {



    $('#pseudo').keyup(function () {
        var pseudo = $('#pseudo').val();
        if (pseudo != "") {
            $.post('../AJAX/pseudo.php', { pseudo: pseudo }, function (data) {
                    
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
            beforeSend: function () {
                $('.load-img').removeClass("invisible");
                
                $('#error-confmdp').addClass("d-none");
                $('#error-mdp').addClass("d-none");
                $('#error-email').addClass("d-none");
                $('#error-pseudo').addClass("d-none");
                $('#error-nom').addClass("d-none");
                $('#error-prenom').addClass("d-none");

                $("input").removeClass("inputerror");
                $("#error").addClass("invisible");
            },
            url: "../AJAX/inscription.php",
            data: $(this).serialize(),
            success: function (response) {
                if (response != '') {
                    
                    if (response == 'invalid_captcha') {
                        $("#error").removeClass("invisible");
                        $("#error").text("Captcha invalide, réessayez");
                        grecaptcha.reset();
                    } else if (response=='EXIST_EMAIL') {
                        $("#error").removeClass("invisible");
                        $("#error").text("Vous êtes déjà inscrit avec cet email");
                    } else if (response=='EXIST_PSEUDO') {
                        $("#error").removeClass("invisible");
                        $("#error").text("Ce pseudo existe déjà");
                    } else if (response=='INSCR_OK') {
                           location.href = '../profil.php';   // à modifier après (vers confirm_inscr.php)
                    }
                    else {
                        $("#error").addClass("invisible");
                        arr = JSON.parse(response);
                        err = false;
                        
                        for (var champ in arr) {
                            if(arr[champ]) {
                                err=true;
                                break;
                            }
                        }

                        if (err) {
                            
                            for (var champ in arr) {
                                if(arr[champ]!=0) {
                                    $('#'+champ).addClass("inputerror");
                                } else {
                                    $('#'+champ).removeClass("inputerror");
                                }
                            }
                            


                            // check error-nom
                            if (arr['nom']==1) {
                                $('#error-nom').removeClass("d-none"); 
                                $('#error-nom').text("Le nom doit avoir uniquement des lettres");
                            }
                            else if(arr['nom']==0) { 
                                $('#error-nom').addClass("d-none");
                            }


                            // check error-prenom
                            if (arr['prenom']==1) {
                                $('#error-prenom').removeClass("d-none"); 
                                $('#error-prenom').text("Le prénom doit avoir uniquement des lettres");
                            }
                            else if(arr['prenom']==0) { 
                                $('#error-prenom').addClass("d-none");
                            }


                            // check error-pseudo
                            if (arr['pseudo']==1) {
                                $('#error-pseudo').removeClass("d-none"); 
                                $('#error-pseudo').text("Le pseudo doit avoir entre 3 et 20 caractéres et uniquement des chiffres, lettres ou un tiret bas");
                            }
                            else if(arr['pseudo']==0) { 
                                $('#error-pseudo').addClass("d-none");
                            }


                            // check error-email
                            if (arr['email']==3) {
                                $('#error-email').removeClass("d-none");
                                $('#error-email').text("L'email n'existe pas");
                            }
                            else if(arr['email']==1) { 
                                $('#error-email').removeClass("d-none");
                                $('#error-email').text("Email invalide");
                            }
                            else if(arr['email']==0) { 
                                $('#error-email').addClass("d-none");
                            }



                            // check error-mdp
                            if (arr['mdp']==1) {
                                $('#error-mdp').removeClass("d-none"); 
                                $('#error-mdp').text("Le mot de passe doit avoir 8 caractéres minimum et contenir lettres minuscules, majuscule et un symbole");
                            }
                            else if(arr['mdp']==0) { 
                                $('#error-mdp').addClass("d-none");
                            }


                            // check error-confmdp
                            if (arr['confmdp']==1) {
                                $('#error-confmdp').removeClass("d-none");
                                $('#error-confmdp').text("Confirmation mot de passe incorrecte");
                            }
                            else if(arr['confmdp']==0) { 
                                $('#error-confmdp').addClass("d-none");
                            }


                            



                            

                        }
                        
                    }
                } else {
                    
                }
            },
            complete: function () {
                console.log("trés bien c fini");
                $('.load-img').addClass("invisible");
                
            }
        });
    })
    
});

