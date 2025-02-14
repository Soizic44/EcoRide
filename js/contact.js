//Implémenter le JS de ma page
const inputNom = document.getElementById("name");
const inputPreNom = document.getElementById("firstname");
const inputMail = document.getElementById("email");

inputNom.addEventListener("keyup", validateForm); 
inputPreNom.addEventListener("keyup", validateForm);
inputMail.addEventListener("keyup", validateForm);

//Function permettant de valider tout le formulaire
function validateForm(){
    validateRequired(inputNom);
    validateRequired(inputPreNom);
}

function validateRequired(input){
    if(input.value != ''){
        input.classList.add("isValid");
        input.classList.remove("isInvalid"); 
    }
    else{
        input.classList.remove("isValid");
        input.classList.add("isInvalid");
    }
}

