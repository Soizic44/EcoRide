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
    die("Erreur de connexion à la base de données : ". $e->getMessage());
}

//Soumission du formulaire
if(isset($_POST['submit'])) {   

    // Vérification que tous les champs requis sont remplis
    if(isset($_POST['email'], $_POST['mdp'])
        && !empty($_POST['email']) && !empty($_POST['mdp']))
    {
        // Le formulaire est complet
        // Assignation et récupération des données en les protégeant
        $emailForm = $_POST['email'];

        // Vérification que la valeur est bien un email
        if(!filter_var($emailForm, FILTER_VALIDATE_EMAIL)){
            die("L'adresse email est incorecte");
        }

        //Récupérer les utilisateurs
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

        //Est-ce que l’utilisateur (mail) existe ?
        if($stmt->rowCount() == 1){
            $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
            // User existant --> Vérification du MP
            if(!password_verify($mdpForm, $monUser['mdp'])){
                // Message erreur pour eviter les passages en force (pas d'indices)
                die("L'utilisateur et/ou le mot de passe est incorrect");
            }
            // Connexion réussi : on connecte l'utilisateur et on démarre la session PHP
            //--> Ici c'est Javascript qui est programmer pour le faire
            session_start(); 

            //Stocker dans $_SESSION les informations de l'utilisateur
            $_SESSION["users"] = [
                "idUser" => $users['id_user'],
                "pseudo" => $users['pseudo'],
                "nom" => $users['nom'],
                "prenom" => $users['prenom'],
                "email" => $users['email']
            ];
            //Redirection vers la page voulue
            header("Location: /"); 
        }
        else{
            echo "Utilisateur introuvable, êtes-vous sûr de votre mail ?";
        }
    }    
}
?>

