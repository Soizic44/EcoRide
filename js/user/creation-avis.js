//Implémenter le JS de ma page
const inputPseudo = document.getElementById("name");
const inputMail = document.getElementById("email");
const inputDate = document.getElementById("date");
const inputStart = document.getElementById("start");
const inputHeureDep = document.getElementById("heureDep");
const inputArrival = document.getElementById("arrival");
const inputHeureArr = document.getElementById("heureArr");
const inputPseudoCond = document.getElementById("pseudo-conducteur");
const inputNote = document.getElementById("note");
const inputMessage = document.getElementById("message");
const btnValidation = document.getElementById("envoiAvis");

inputPseudo.addEventListener("keyup", validateForm); 
inputMail.addEventListener("keyup", validateForm);
inputDate.addEventListener("keyup", validateForm);
inputStart.addEventListener("keyup", validateForm);
inputHeureDep.addEventListener("keyup", validateForm);
inputArrival.addEventListener("keyup", validateForm);
inputHeureArr.addEventListener("keyup", validateForm);
inputPseudoCond.addEventListener("keyup", validateForm);
inputNote.addEventListener("keyup", validateForm);
inputMessage.addEventListener("keyup", validateForm);


//Function permettant de valider tout le formulaire
function validateForm(){
    const pseudoOk = validateRequired(inputPseudo);
    const mailOk = validateMail(inputMail);
    const dateOk = validateRequired(inputDate);
    const startOk = validateRequired(inputStart);
    const heureDepOk = validateRequired(inputHeureDep);
    const arrivalOk = validateRequired(inputArrival);
    const heureArrOk = validateRequired(inputHeureArr);
    const pseudoCondOk = validateRequired(inputPseudoCond);
    const noteOk = validateRequired(inputNote);
    const messageOk = validateMessage(inputMessage);

    if(pseudoOk && mailOk && dateOk && startOk && heureDepOk && arrivalOk && heureArrOk && pseudoCondOk && noteOk && messageOk){
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

//Définir mon regex message
function validateMessage(input){
    const messageRegex = /^(?=.{8,})[a-zA-Z0-9\s\-,]+.\*?$/;
    const messageContact = input.value;

    if(messageContact.match(messageRegex)){
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