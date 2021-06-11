$("#profileImage").click(function (e) {
    $("#imageUpload").click();
});

function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        $('#profileImage').attr('src',
            window.URL.createObjectURL(uploader.files[0]));
    }
}

$("#imageUpload").change(function () {
    fasterPreview(this);
});


function verif() {
    var mdp1 = document.getElementById("Password").value;
    var mdp2 = document.getElementById("Password2").value;



    if (mdp1 === mdp2) {

        document.getElementById("success").innerHTML = "les mots de passe  sont  identique";
        document.getElementById("erreur").innerHTML = "";
        return true;

    } else {

        document.getElementById("erreur").innerHTML = "les mots de passe ne sont  identique";
        document.getElementById("success").innerHTML = "";
        return false;
    }

}

