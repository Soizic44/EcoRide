<?php
// Empêche les utilisateurs connectés d'accéder à l'inscription
if(isset($_SESSION["users"])){
    header("Location: /");
    exit;
}

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

//Soumission du formulaire
if(isset($_POST['submit'])){   

    // Vérification que tous les champs requis sont remplis
    if(isset($_POST['email'], $_POST['mdp'], $_POST['confirmPw'])
        && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['confirmPw'])
    ){
        // Le formulaire est complet
        // Assignation et récupération des données en les protégeant
        $emailForm = $_POST['email'];
        // Vérification que la valeur est bien un email
        if(!filter_var($emailForm, FILTER_VALIDATE_EMAIL)){
            die("L'adresse email est incorecte");
        }

        //Vérifier l’unicité de l’adresse mail
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

        //Est-ce que l’utilisateur (mail) existe ?
        if($stmt->rowCount() == 1){
            $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            "Utilisateur introuvable, êtes-vous sûr de votre mail ?";
        }

        //vérification que les 2 mots de passe sont identique
        if($_POST['mdp'] === $_POST['confirmPw']) {
            
            // Hashage(encryptage) du mot de passe
            $mdpForm = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            $confirmPwForm = password_hash($_POST['confirmPw'], PASSWORD_BCRYPT);
        }

        // Modification du mot de passe de la base de données par le nouveau
        $query = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':password', $mdpForm);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

        // Récupération de l'id de nouvel utilisateur
        $id_user = $pdo->lastInsertId();

        //Redirection vers page 
        header("Location: /connexion");

    }else{
        die("Le formulaire est imcomplet");
    }
}
?>