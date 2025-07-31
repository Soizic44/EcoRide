//Implémenter le JS de ma page
const mailInput      = document.getElementById("email");
const passwordInput  = document.getElementById("password");
const btnSingin      = document.getElementById("btnConnexion");
const feedMail       = document.getElementById("feedMail");
const feedPw         = document.getElementById("feedPw");

mailInput.addEventListener("keyup", validateForm);
passwordInput.addEventListener("keyup", validateForm);
btnSingin.addEventListener("click", checkCredentials);


//Function permettant de valider les input
//Function permettant de valider tout le formulaire
function validateForm(){
    const mailOk = validateMail(mailInput);
    const passwordOk = validateMp(passwordInput);

    if(mailOk && passwordOk){
        btnSingin.disabled = false;
    }
    else{
        btnSingin.disabled = true;
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

//Définir mon regex mot de passe
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

// Appel de l'Api 
//function callApi(){const url = "/connect.php"
    // demande de recherche dans Api(fetch) puis au retour de reponse => convertion en tableau
    //fetch(url).then(response => response.json()).then(data => {
        //document.getElementById("btnConnexion").innerHTML = data})
//}
async function callApi(){
    const url = "/connect.php"
    const fetcher = await fetch(url)
    const json = await fetcher.json()
    console.log(json)
}

//Gestion de la connexion
function checkCredentials(){
    //Ici, on appel API pour vérifier les credentials en BDD
    callApi();

    if(mailInput.value == "test@gmail.com" && passwordInput.value == "Password123."){
        //Il faudra récupérer le vrai token
        const token = "lkjsdngfljsqdnglkjsdbglkjqskjgkfjgbqslkfdgbskldfgdfgsdgf";
        setToken(token);
        //placer ce token en cookie
        
        setCookie(RoleCookieName, "admin", 7);
        window.location.replace("/profil");
    }
    else{
        mailInput.classList.add("invalid");
        passwordInput.classList.add("invalid");
    }
}


