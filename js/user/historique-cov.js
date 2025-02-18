const inputStart = document.getElementById("start");
const inputStop = document.getElementById("stop");

inputStart.addEventListener('click', maskStart);
inputStop.addEventListener('click', annulerDemarrer);


//méthode permettant de masquer le boutton "Start" si clic et afficher boutton "Stop"
document.getElementById('start').change = function(){ 
    maskStart('.start', this.checked); 
} 
function maskStart(){
    if (inputStart.checked){
        document.getElementById("start").style.display ="block";
        document.getElementById("stop").style.display ="none";
    } 
    else{
        document.getElementById("start").style.display ="none";
        document.getElementById("stop").style.display ="block";
    }
}

//méthode permettant d'annuler le "Démarrer"
document.getElementById('stop').change = function(){ 
    annulerDemarrer('.stop', this.checked); 
}
function annulerDemarrer(){
    if (inputStop.checked){
        document.getElementById("start").style.display ="none";
        document.getElementById("stop").style.display ="block";
    } 
    else{
        document.getElementById("start").style.display ="block";
        document.getElementById("stop").style.display ="none";
    }
}
 






