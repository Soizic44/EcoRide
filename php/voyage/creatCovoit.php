<?php
// Empêche les utilisateurs connectés d'accéder à l'inscription
if(isset($_SESSION["users"])){
    header("Location: /");
    exit;   
}

?>       