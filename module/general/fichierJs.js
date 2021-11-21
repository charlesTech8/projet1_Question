// Dans cette fichier nous allons écrire nos script js
function hideThis(_div) {
    var obj = document.getElementById(_div);
    if (obj.style.display == "block")
        obj.style.display = "none";
    else
        obj.style.display = "block";
}

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