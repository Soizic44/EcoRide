<?php
//Récuperation de mes variables de connexion
$dsn = 'mysql:host=localhost;dbname=ecoride';
$username = 'user_php';
$password = '5f7zfgIo8SF25R';

//Création connexion PDO
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupérer les données du formulaire de connexion
    $mailForm = $_POST['email'];
    $passwordForm = $_POST['password'];

    //Récupérer les utilisateurs 
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $mailForm);
    $stmt->execute();  
    
    //Est-ce que l’utilisateur (mail) existe ?
    //Si il existe
    if($stmt->rowCount() == 1){
        //Récupération des valeur de l'utilisateur
        $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
        //Encripter la proposition de l'utilisateur et vérifier si il correspond aux valeur saisie
        if(password_verify($passwordForm, $monUser['password'])){
            echo "Connexion réussie ! Bienvenue " . $monUser['nom'] . $monUser['prenom'];
        }else{
            echo "Mot de passe incorrect";
        }
    }
    else{
        echo "Utilisateur introuvable, êtes-vous sûr de votre mail ?";
    }
}
catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}
?>