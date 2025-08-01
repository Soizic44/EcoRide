//Gestion de la connexion
const tokenCookieName = "accesstoken";
const RoleCookieName = "role";
const signoutBtn = document.getElementById("deconnexion");
const apiUrl = "https:127.0.0.1:8000/ecoride/php/authentif/connect.php";

signoutBtn.addEventListener("click", signout);
getInfosUser();

//Gestion du rôle
function getRole(){
    return getCookie(RoleCookieName);
}
//Gestion de la déconnexion
function signout(){
    eraseCookie(tokenCookieName);
    eraseCookie(RoleCookieName);
    window.location.reload();
}

//Placer le token en cookie
function setToken(token){
    setCookie(tokenCookieName, token, 7);
}

//pour retourner le cookie du token
function getToken(){
    return getCookie(tokenCookieName);
}

//Méthode pour gestion des cookies
function setCookie(name,value,days){
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name){
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name){   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

//Savoir si on est connecté
function isConnected(){
    if(getToken() == null || getToken == undefined){
        return false;
    }
    else{
        return true;
    }
}

/*
disconnected (visiteur)
connected (admin, employé ou utilisateur)
    - admin
    - employé
    - chauffeur
    - passager
    - utilisateur/user : chauffeur et passager
*/
function showAndHideElementsForRoles(){
    const userConnected = isConnected();
    const role = getRole();

    let allElementsToEdit = document.querySelectorAll('[data-show]');
    allElementsToEdit.forEach(element =>{
        switch(element.dataset.show){
            case 'disconnected':
                if(userConnected){
                    element.classList.add("d-none");
                }
                break;
            case 'connected': 
                if(!userConnected){
                    element.classList.add("d-none");
                }
                break;
            case 'admin': 
                if(!userConnected || role != "admin"){
                    element.classList.add("d-none");
                }
                break;
            case 'employe': 
                if(!userConnected || role != "employe"){
                    element.classList.add("d-none");
                }
                break;
            case 'chauffeur': 
                if(!userConnected || role != "chauffeur"){
                    element.classList.add("d-none");
                }
                break;
            case 'passager': 
                if(!userConnected || role != "passager"){
                    element.classList.add("d-none");
                }
                break;
            case 'user': 
                if(!userConnected || role != "user"){
                    element.classList.add("d-none");
                }
                break; 
        }
    })
}

// "Assainir" mon HTML quand on récupère des information externe
function sanitizeHtml(text){
    // Créez un élément HTML temporaire de type "div"
    const tempHtml = document.createElement('div');
    
    // Affectez le texte reçu en tant que contenu texte de l'élément "tempHtml"
    tempHtml.textContent = text;
    
    // Utilisez .innerHTML pour récupérer le contenu de "tempHtml"
    // Cela va "neutraliser" ou "échapper" tout code HTML potentiellement malveillant
    return tempHtml.innerHTML;
}

// Récupérer les informations utilisateurs
function getInfosUser(){
    console.log("Récupération info user");
}