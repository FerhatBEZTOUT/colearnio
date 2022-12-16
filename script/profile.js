$(document).ready(function () {

$("#edit_profile").click(function (e) { 
   
    $("input").addClass("form-control");
    $("input").prop('readonly', false);
    $("#btn-modifier").removeClass("d-none");
    $("#edit_profile").addClass("d-none");
    $("#inputImage").removeClass("invisible");
    $("#labelImage").removeClass("invisible");
    
});


})