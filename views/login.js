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
        document.forms['contact'].reset();
        return true;

    } else {

        document.getElementById("erreur").innerHTML = "les mots de passe ne sont pas  identique";
        document.getElementById("success").innerHTML = "";
        return false;
    }

}
formulaire2.style.display = 'none';
function display(){
    // on récupère l'élément form.
    
    var formulaire2 = document.getElementById('formulaire2');
    var formulaire = document.getElementById('formulaire');
  
    
   
        formulaire2.style.display = 'block';
        formulaire.style.display = 'none';
    }
function display2(){
    .
    
    var formulaire2 = document.getElementById('formulaire2');
    var formulaire = document.getElementById('formulaire');
  
    
    
        formulaire2.style.display = 'none';
        formulaire.style.display = 'none';
    }







