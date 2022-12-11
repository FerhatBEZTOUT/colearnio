$(document).ready(function(){
    $.get('../Controller/verificationEmail.php',{email:email},function(data){
        console.log(data);
    });

});