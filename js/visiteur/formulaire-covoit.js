//Implémenter le JS de ma page
const form = document.getElementById("formItineraire");
const inputStart = document.getElementById("start");
const inputArrival = document.getElementById("arrival");
const inputDate = document.getElementById("date");
const btnValidation = document.getElementById("searchItineraire");

inputStart.addEventListener("keyup", validateForm); 
inputArrival.addEventListener("keyup", validateForm);
inputDate.addEventListener("keyup", validateForm);
btnValidation.addEventListener("click", checkCredentials);


//Function permettant de valider tout le formulaire
function validateForm(){
    const startOk = validateRequired(inputStart);
    const arrivalOk = validateRequired(inputArrival);
    const dateOk = validateRequired(inputDate);

    if(startOk && arrivalOk && dateOk){
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