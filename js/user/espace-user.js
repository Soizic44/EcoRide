//Implémenter le JS de ma page
const form1 = document.getElementById("formChoice");
const form2 = document.getElementById("formUser");
const inputImmatriculation = document.getElementById("immatriculation");
const inputFirstImmat = document.getElementById("FirstImmat");
const inputMarque = document.getElementById("marque");
const inputModele = document.getElementById("modèle");
const inputCouleur = document.getElementById("couleur");
const inputPlaces = document.getElementById("places");
const inputFumeur = document.getElementById("fumeur");
const inputAnimal = document.getElementById("animal");
const btnValidation = document.getElementById("envoiCreateUser");

inputImmatriculation.addEventListener("keyup", validateForm); 
inputFirstImmat.addEventListener("keyup", validateForm);
inputMarque.addEventListener("keyup", validateForm);
inputModele.addEventListener("keyup", validateForm);
inputCouleur.addEventListener("keyup", validateForm); 
inputPlaces.addEventListener("keyup", validateForm); 
inputFumeur.addEventListener("keyup", validateForm);
inputAnimal.addEventListener("keyup", validateForm);


//Function permettant de valider tout le formulaire
function validateForm(){
    const immatOk = validateRequired(inputImmatriculation);
    const firstImmatOk = validateRequired(inputFirstImmat);
    const marqueOk = validateRequired(inputMarque);
    const modeleOk = validateRequired(inputModele);
    const couleurOk = validateRequired(inputCouleur);
    const placesOk = validateRequired(inputPlaces);
    const fumeurOk = validateRequired(inputFumeur);
    const animalOk = validateRequired(inputAnimal);

    if(immatOk && firstImmatOk && marqueOk && modeleOk && couleurOk && placesOk && fumeurOk && animalOk){
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

//méthode permettant d'afficher le champ si "chauffeur"
document.getElementById('chauffeur').change = function(){ 
    afficheForm('.chauffeur', this.checked); 
}  
function afficheForm(){
    if (form1.chauffeur.checked){
        document.getElementById("formUser").style.display ="block";
    } 
    else{
        document.getElementById("formUser").style.display ="null";
    }
}

//méthode permettant de masquer le block form-User si selection "passager"
document.getElementById('passager').change = function(){ 
    maskForm('.passager', this.checked); 
} 
function maskForm(){
    if (form1.passager.checked){
        document.getElementById("formUser").style.display ="none";
    } 
    else{
        document.getElementById("formUser").style.display ="null";
    }
}

//méthode permettant d'afficher le champ si "chauffeur et passager" sélectionné
document.getElementById('les2').change = function(){ 
    afficheForm1('.les2', this.checked); 
}
function afficheForm1(){
    if (form1.les2.checked){
        document.getElementById("formUser").style.display ="block";
    } 
    else{
        document.getElementById("formUser").style.display ="null";
    }
}

