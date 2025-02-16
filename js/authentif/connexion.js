//Implémenter le JS de ma page
const mailInput = document.getElementById("mail");
const passwordInput = document.getElementById("password");
const btnConnexion = document.getElementById("btnConnexion");

mailInput.addEventListener("keyup", validateForm);
passwordInput.addEventListener("keyup", validateForm);

//Function permettant de valider les input
function validateForm(){
    validateRequired(mailInput);
    validateRequired(passwordInput);
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

//Function permettant de valider tout le formulaire
function validateForm(){
    const mailOk = validateMail(mailInput);
    const passwordOk = validateMp(passwordInput);

    if(mailOk && passwordOk){
        btnConnexion.disabled = false;
    }
    else{
        btnConnexion.disabled = true;
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

//Définir mon regex
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

btnConnexion.addEventListener("click", checkCredentials);
function checkCredentials(){
    //Ici, il faudra appeler l'API pour vérifier les credentials en BDD

    if(mailInput.value == "test@mail.com" && passwordInput.value == "123"){
        //Il faudra récupérer le vrai token
        const token = "lkjsdngfljsqdnglkjsdbglkjqskjgkfjgbqslkfdgbskldfgdfgsdgf";
        setToken(token);
        //placer ce token en cookie
        
        window.location.replace("/");
    }
    else{
        mailInput.classList.add("invalid");
        passwordInput.classList.add("invalid");
    }
}
