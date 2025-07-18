//Implémenter le JS de ma page
const inputNom      = document.getElementById("nom");
const inputPrenom   = document.getElementById("prenom");
const inputMail     = document.getElementById("email");
const inputObjet    = document.getElementById("objet");
const inputMessage  = document.getElementById("message");
const btnValidation = document.getElementById("envoiContact");
const msg           = document.getElementById("formOutput");
const loader        = document.getElementById("loaderContent");

inputNom.addEventListener("keyup", validateForm); 
inputPrenom.addEventListener("keyup", validateForm);
inputMail.addEventListener("keyup", validateForm);
inputObjet.addEventListener("keyup", validateForm);
inputMessage.addEventListener("keyup", validateForm);

//fonction permettant de mettre en place le loader de gestion d'attente
document.getElementById("envoiContact").onclick = function(){
    afficheLoader("envoiContact", this.click);
}
function afficheLoader(){
    if(formulaire.envoiContact.click){
        loader.classList.add("active");
    }
    else{
        loader.classList.remove("active");
    } 
}

//Function permettant de valider tout le formulaire
function validateForm(){
    const nomOk = validateRequired(inputNom);
    const prenomOk = validateRequired(inputPrenom);
    const mailOk = validateMail(inputMail);
    const objetOk = validateRequired(inputObjet);
    const messageOk = validateMessage(inputMessage);

    if(nomOk && prenomOk && mailOk && objetOk && messageOk){
        btnValidation.disabled = false;
        msg.textContent = "";
    }
    else{
        btnValidation.disabled = true;
    }
}

function validateRequired(input){
    if(input.value != ''){
        input.classList.add("valid");
        input.classList.remove("invalid");
        return true; 
    }
    else{
        input.classList.remove("valid");
        input.classList.add("invalid");
        msg.textContent = "Merci de remplir les champs manquants";
        msg.classList.add("invalid");
        return false;
    }
}

//Définir mon regex Email
function validateMail(input){       
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const mailContact = input.value;

    if(mailContact.match(emailRegex)){
        input.classList.add("valid");
        input.classList.remove("invalid"); 
        return true;
    }
    else{
        input.classList.remove("valid");
        input.classList.add("invalid");
        msg.textContent = "Votre adresse email est incorrecte";
        msg.classList.add("invalid");
        return false;
    }
}

//Définir mon regex message
function validateMessage(input){
    const messageRegex = /^(?=.{10,})[a-zA-Z0-9\s\-,]+.\*?$/;
    const messageContact = input.value;

    if(messageContact.match(messageRegex)){
        input.classList.add("valid");
        input.classList.remove("invalid"); 
        return true;
    }
    else{
        input.classList.remove("valid");
        input.classList.add("invalid");
        msg.textContent = "Votre message doit avoir au moins 10 caractères.";
        msg.classList.add("invalid");
        return false;
    }
}
