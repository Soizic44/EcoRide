//Implémenter le JS de ma page
const form = document.getElementById("formContact");
const inputNom = document.getElementById("name");
const inputPrenom = document.getElementById("firstname");
const inputMail = document.getElementById("email");
const inputTitre = document.getElementById("titre");
const inputMessage = document.getElementById("message");
const btnValidation = document.getElementById("envoiContact");

inputNom.addEventListener("keyup", validateForm); 
inputPrenom.addEventListener("keyup", validateForm);
inputMail.addEventListener("keyup", validateForm);
inputTitre.addEventListener("keyup", validateForm);
inputMessage.addEventListener("keyup", validateForm);


//Function permettant de valider tout le formulaire
function validateForm(){
    const nomOk = validateRequired(inputNom);
    const prenomOk = validateRequired(inputPrenom);
    const mailOk = validateMail(inputMail);
    const titreOk = validateMail(inputTitre);
    const messageOk = validateMail(inputMessage);

    if(nomOk && prenomOk && mailOk && titreOk && messageOk){
        btnValidation.disabled = false;
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
        return false;
    }
}

