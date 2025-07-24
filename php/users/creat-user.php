<?php
// Traitement du formulaire
if(!empty($_POST)){
    //POST n'est pas vide, on vérifie que toutes les données sont présentes
    if(
        isset($_FILES['photo'], $_POST['immatriculation'], $_POST['dateImmat'], $_POST['marque'], $_POST['modele'], $_POST['couleur'])
        && !empty($_POST['photo']) && !empty($_POST['immatriculation']) && !empty($_POST['dateImmat']) && !empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['couleur'])
    ){
        // Le formulaire est complet
        // Récupération des données en les protégeant(failles xxs)
        // On neutralise toute balise des ajouts de préférences
        $ajoutPrefForm = htmlspecialchars($_POST['ajoutPref']);

        // Connexion à la base de données
        // Récuperation de mes variables de connexion
        $dsn = 'mysql:host=localhost;dbname=ecoride';
        $username = 'user_php';
        $password = '5f7zfgIo8SF25R';

        // Connexion PDO à la base de données
        try{
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo "Erreur de connexion à la base de données : ". $e->getMessage();
        }

        // Requête
        //Assignation des variables du formulaire
        if(isset($_POST['submit'])){  
            $choixForm = $_POST['choix'];
            $photoForm = $_FILES['photo'];
            $immatForm = $_POST['immatriculation'];
            $dateImmatForm = $_POST['dateImmat'];
            $marqueForm = $_POST['marque'];
            $modeleForm = $_POST['modele'];
            $couleurPwForm = $_POST['couleur'];
            $electForm = $_POST['elect'];
            $fumeurForm = $_POST['fumeur'];
            $animalForm = $_POST['animal'];
            $ajoutPrefForm = $_POST['ajoutPref'];

            //Récupérer la clé primaire de la table "users"
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $emailForm);
            $stmt->execute();$requete->execute(
                array(
                    "pseudo" => $pseudoForm,
                    "nom" => $nomForm,
                    "prenom" => $prenomForm,
                    "email" => $emailForm,
                    "mdp" => $hashedMpd,
                    "confirmPw" => $hashedConfMpd
                )
            );
            //Préparation de la requête d'insertion (SQL)
            $requete = $pdo->prepare("INSERT INTO voiture VALUES (0, :immatriculation, :dateImmat, :marque, :modele, :couleur, :elect)");
            //Insertion des données saisies en base de données
            $requete->execute(
                array(
                    "pseudo" => $pseudoForm,
                    "nom" => $nomForm,
                    "prenom" => $prenomForm,
                    "email" => $emailForm,
                    "mdp" => $hashedMpd,
                    "confirmPw" => $hashedConfMpd
                )
            );
            //Redirection vers page 
            header("Location: /espace-user");
}

    }else{
        die("Le formulaire est incomplet");
    }
}







?>