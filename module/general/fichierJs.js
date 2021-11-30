// Dans cette fichier nous allons écrire nos script js
function hideThis(_div) {
    var obj = document.getElementById(_div);
    if (obj.style.display == "block")
        obj.style.display = "none";
    else
        obj.style.display = "block";
}

$(function() {


    $("#msgForm").submit(function(e) {
        e.preventDefault();
        var msg = $('#msg').val();
        var iduser = $('#id_author').val();
        var action = $('#sendMsg').val();
        $.ajax({
            type: 'post',
            url: '../module/connect_mod/admin_mod.php',
            data: {
                action: action,
                msg: msg,
                iduser: iduser
            },
            cache: false,
            success: function(reponse) {}
        });
        return false;
    });
});

// function checkPass() {
//     var pass1 = $("#pwd").val();
//     var passConfirm = $("#confirmPwd").val();

//     if (pass1 != passConfirm) {
//         $("#info").html("Mot de passe invalide !");
//         var texte = document.getElementById("info");
//         texte.setAttribute("style", "color:red");
//     } else {
//         $("#info").html("Mot de passe valide");
//         var texte = document.getElementById("info");
//         texte.setAttribute("style", "color:green");
//     }
// }