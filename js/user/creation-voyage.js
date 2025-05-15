//Implémenter le JS de ma page
const inputDate = document.getElementById("date");
const inputStart = document.getElementById("start");
const inputHeureDep = document.getElementById("heureDep");
const inputArrival = document.getElementById("arrival");
const inputHeureArr = document.getElementById("heureArr");
const inputTime = document.getElementById("time");
const inputPrice = document.getElementById("price");
const btnAdition = document.getElementById("car");
const btnValidation = document.getElementById("createVoyage");

inputDate.addEventListener("keyup", validateForm);
inputStart.addEventListener("keyup", validateForm);
inputHeureDep.addEventListener("keyup", validateForm); 
inputArrival.addEventListener("keyup", validateForm);
inputHeureArr.addEventListener("keyup", validateForm);
inputTime.addEventListener("keyup", validateForm);
inputPrice.addEventListener("keyup", validateForm);
btnAdition.addEventListener("keyup", validateForm);


//Function permettant de valider tout le formulaire
function validateForm(){
    const dateOk = validateRequired(inputDate);
    const startOk = validateRequired(inputStart);
    const heureDepOk = validateRequired(inputHeureDep);
    const arrivalOk = validateRequired(inputArrival);
    const heureArrOk = validateRequired(inputHeureArr);
    const timeOk = validateRequired(inputTime);
    const priceOk = validateRequired(inputPrice);
    const btnAditionOk = validateRequired(btnAdition);

    if(dateOk && startOk && heureDepOk && arrivalOk && heureArrOk && timeOk && priceOk && btnAditionOk){
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