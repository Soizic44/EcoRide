<?php
//Récuperation de mes variables de connexion
$dsn = 'mysql:host=localhost;dbname=ecoride';
$username = 'user_php';
$password = '5f7zfgIo8SF25R';

//Création connexion PDO
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}
//Assignation des variables du formulaire
if(isset($_POST['submit'])){   
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $confirmPw = $_POST['confirmPw'];

    //Insertion des données saisies en base de données
    $requete = $pdo->prepare("INSERT INTO users VALUES (0, :pseudo, :nom, :prenom, :email, MD5:mdp, MD5:confirmPw)");
    $requete->execute(
        array(
            "pseudo" => $pseudo,
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "mdp" => $mdp,
            "confirmPw" => $confirmPw
        )
    );
    //Redirection vers page 
    echo "Inscription réussie ! ";
}
?>