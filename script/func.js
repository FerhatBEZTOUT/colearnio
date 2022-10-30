$(document).ready(function(){
    $('#inputPseudo').keyup(function(){
        var pseudo = $('#inputPseudo').val();
        if(pseudo !=""){
            $.post('pseudo.php',{pseudo:pseudo},function(data){
                console.log(data);
                if (data=='dispo') {
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
});