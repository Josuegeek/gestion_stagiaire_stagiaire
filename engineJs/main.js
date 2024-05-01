
//fonction pour la deconnexion de l'utilisateur
function deconnexionStagiaire(){
    if(confirm("voulez-vous vous deconnecter?")){
        window.location.href = `./enginePhp/disconnect.php`;
    }
}