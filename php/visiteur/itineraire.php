<?php
// Connexion PDO
include_once "php/connexPhp.php";

// Vérification
// Vérification que tous les champs requis sont remplis
if(isset($_GET['start'], $_GET['arrival'], $_GET['date'])
    && !empty($_GET['start']) && !empty($_GET['arrival']) && !empty($_GET['date']))
{
    // Assignation et récupération des données en les protégeant

    //Supprimer les balises html dans la requête
    $start = strip_tags($_GET['start']);
    $arrival = strip_tags($_GET['arrival']);
    $date = strip_tags($_GET['date']);

    // Sécuriser le formulaire contre les failles html
    $_GET["terme"] = htmlspecialchars($_GET["terme"]);

    // Supprimer les espaces dans la requête de l'internaute
    $terme = trim($terme);

    
        
}