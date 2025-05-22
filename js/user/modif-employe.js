//Implémenter le JS de ma page
const inputNom = document.getElementById("name");
const inputPrenom = document.getElementById("firstname");
const inputMail = document.getElementById("email");
const inputTitre = document.getElementById("role");
const inputPassword = document.getElementById("password");
const inputConfirmPw = document.getElementById("validation-password");
const btnValidation = document.getElementById("valider");

inputNom.addEventListener("keyup", validateForm); 
inputPrenom.addEventListener("keyup", validateForm);
inputMail.addEventListener("keyup", validateForm);
inputTitre.addEventListener("keyup", validateForm);
inputPassword.addEventListener("keyup", validateForm);
inputConfirmPw.addEventListener("keyup", validateForm);


//Function permettant de valider tout le formulaire
function validateForm(){
    const nomOk = validateRequired(inputNom);
    const prenomOk = validateRequired(inputPrenom);
    const mailOk = validateMail(inputMail);
    const titreOk = validateRequired(inputTitre);

    if(nomOk && prenomOk && mailOk && titreOk){
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

//Définir mon regex mot de passe et vérification du mot de passe
function validateMp(input){
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
    const passwordUser = input.value;
    if(passwordUser.match(passwordRegex)){
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

function validateConfirmationMp(inputPassword, inputConfirmPw){
    if(inputPassword.value == inputConfirmPw.value){
        inputConfirmPw.classList.add("valid");
        inputConfirmPw.classList.remove("invalid");
        return true;
    }
    else{
        inputConfirmPw.classList.add("invalid");
        inputConfirmPw.classList.remove("valid");
        return false;
    }
}