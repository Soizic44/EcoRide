<!--START : hero-->
<section class="hero_accueil hero">
    <h1>Compte utilisateur de</h1>
</section>
<!--END : hero-->

<!--START : Modifier voyage-->
<section class="formulaire bgcolor">
    <div class="containForm padding card">
    </div>
</section>
<!--END : Modifier voyage-->

<?php
session_start();

// Empêche les utilisateurs non connectés d'accéder à la déconnexion
if(!isset($_SESSION["users"])){
    header("Location: /");
    exit;
}

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

// Récupération de la liste des utilisateurs (users)
$query = "SELECT * FROM users WHERE";
// Execution de la requête
$stmt = $pdo->prepare($query);
// Récupération des données dans la bdd (avec fetch)
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

