//Implémenter le JS de ma page
const inputMail      = document.getElementById("email");
const inputPassword  = document.getElementById("password");
const inputConfirmPw = document.getElementById("confirmPw");
const inputChangeMp  = document.getElementById("btn-changeMp");
const feedMail       = document.getElementById("feedMail");
const feedPw         = document.getElementById("feedPw");
const feedConfPw     = document.getElementById("feedConfPw");


inputMail.addEventListener("keyup", validateForm);
inputPassword.addEventListener("keyup", validateForm);
inputConfirmPw.addEventListener("keyup", validateForm);


//Function permettant de valider tout le formulaire
function validateForm(){
    const mailOk      = validateMail(inputMail);
    const passwordOk  = validateMp(inputPassword);
    const confirmPwOk = validateConfirmMp(inputPassword, inputConfirmPw);

    if(mailOk && passwordOk && confirmPwOk){
        inputChangeMp.disabled = false;
    }
    else{
        inputChangeMp.disabled = true;
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

//Définir mon regex Email et vérification de l'email
function validateMail(input){       
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const mailContact = input.value;


    if(mailContact.match(emailRegex)){
        input.classList.add("valid");
        input.classList.remove("invalid");
        feedMail.style.display = "none";
        return true;
    }
    else{
        input.classList.remove("valid");
        input.classList.add("invalid");
        feedMail.style.display = "";
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
        feedPw.style.display = "none";
        return true;
    }
    else{
        input.classList.remove("valid");
        input.classList.add("invalid");
        feedPw.style.display = "";
        return false;
    }
}

function validateConfirmMp(inputPassword, inputConfirmPw){
    if(inputPassword.value == inputConfirmPw.value){
        inputConfirmPw.classList.add("valid");
        inputConfirmPw.classList.remove("invalid");
        feedConfPw.style.display = "none";
        return true;
    }
    else{
        inputConfirmPw.classList.add("invalid");
        inputConfirmPw.classList.remove("valid");
        feedConfPw.style.display = "";
        return false;
    }
}


