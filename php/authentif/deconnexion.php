<?php
session_start();
// Empêche les utilisateurs non connectés d'accéder à la déconnexion
if(!isset($_SESSION["users"])){
    header("Location: /cpte-user");
    exit;
}
// Supprime une variable
unset($_SESSION["users"]);

header("Location: /");
?>