const mailInput = document.getElementById("mail");
const passwordInput = document.getElementById("password");
const btnConnexion = document.getElementById("btnConnexion");

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
