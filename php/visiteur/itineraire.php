<?php
// Connexion PDO
//Récuperation de mes variables de connexion
$dsn = 'mysql:host=localhost;dbname=ecoride';
$username = 'root';
$password = '';

//Création connexion PDO
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    die("Erreur de connexion à la base de données : ". $e->getMessage());
}

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
    $start = htmlspecialchars($_GET["start"]);
    $arrival = htmlspecialchars($_GET['arrival']);
    $date = htmlspecialchars($_GET['date']);

    // Supprimer les espaces dans la requête de l'internaute
    $start = trim($_GET["start"]);
    $arrival = trim($_GET['arrival']);
    $date = trim($_GET['date']);

    
        
}