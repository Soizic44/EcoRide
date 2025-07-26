<?php
// Traitement du formulaire

// Vérifie si la méthode de la requête est POST et si le champ "command" a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //POST n'est pas vide, on vérifie que toutes les données sont présentes
    if(isset($_POST['email'], $_POST['immatriculation'], $_POST['dateImmat'], $_POST['marque'], $_POST['modele'], $_POST['couleur'])
        //Vérification si un fichier a été envoyé
        && isset($_FILES['image']) && $_FILES['image']['error'] === 0
        // Vérification si champs remplis
        && !empty($_POST['email']) && !empty($_POST['immatriculation']) && !empty($_POST['dateImmat']) && !empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['couleur']))
    {
    
        // Les valeurs requises du formulaire sont complètes
        // Assignation et récupération des données en les protégeant
        if(isset($_POST['submit'])){  
            $choixForm = $_POST['choix'];
            $emailForm = $_POST['email'];
            $photoForm = $_FILES['image'];
            $immatForm = $_POST['immatriculation'];
            $dateImmatForm = $_POST['dateImmat'];
            $marqueForm = $_POST['marque'];
            $modeleForm = $_POST['modele'];
            $couleurForm = $_POST['couleur'];
            $electForm = $_POST['elect'];
            $fumeurForm = $_POST['fumeur'];
            $animalForm = $_POST['animal'];
            $ajoutPrefForm = $_POST['ajoutPref'];
        }

        // Récupération des données en les protégeant(failles xxs)
        // On neutralise toute balise des ajouts de préférences
        if(isset($_POST['ajoutPref'])){
            $ajoutPrefForm = htmlspecialchars($_POST['ajoutPref']);
        }

        // Vérification que la valeur est bien un email
        if(!filter_var($emailForm, FILTER_VALIDATE_EMAIL)){
            die("L'adresse email est incorecte");
        }

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

        //Vérifier l’unicité de l’adresse mail
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

        //Est-ce que l’utilisateur (mail) existe ?
        if($stmt->rowCount() == 0){
            die("Cette adresse email est incorrecte");
        }

        // requete1 Table role
        $query1 = "INSERT INTO 'role' (libelle) VALUE (:choix) 
        INNER JOIN users ON role.id_user = users.id_user 
        WHERE $emailForm = users.email";
        //Préparation de la requête d'insertion (SQL) pour Table role
        $stmt = $pdo->prepare($query1);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':choix', $choixForm);
        $stmt->bindParam(':id_ user', );
        // Executer ma requete 1
        $stmt->execute();

        // requete2 Table voiture
        $query2 = "INSERT INTO voiture (immatriculation, date_immat, marque, modele, couleur, ecolo) 
        VALUE (:immatriculation, :dateImmat, :marque, :modele, :couleur, :elect)
        INNER JOIN users ON voiture.id_user = users.id_user 
        WHERE $emailForm = users.email";
        //Préparation de la requête d'insertion (SQL) pour Table role
        $stmt = $pdo->prepare($query2);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':immatriculation', $immatForm);
        $stmt->bindParam('::dateImmat', $dateImmatForm);
        $stmt->bindParam(':marque', $marqueForm);
        $stmt->bindParam(':modele', $modeleForm);
        $stmt->bindParam(':couleur', $couleurForm);
        $stmt->bindParam(':ecolo',$electForm);
        // Executer ma requete 2
        $stmt->execute();

         // requete3 Table preferences
        $query3 = "INSERT INTO preferences (tabac, animal, preferences) VALUE (:fumeur, :animal, :ajoutPref)
        INNER JOIN voiture ON preferences.id_voiture = voiture.id_voiture 
        WHERE $emailForm = users.email";
        //Préparation de la requête d'insertion (SQL) pour Table role
        $stmt = $pdo->prepare($query3);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':fumeur', $fumeurForm);
        $stmt->bindParam(':animal',$animalForm);
        $stmt->bindParam(':ajoutPref', $ajoutPrefForm);
        // Executer ma requete 3
        $stmt->execute();


        // On récupère l'id role
        $id_role = $pdo->lastInsertId();

        //Redirection vers page 
        header("Location: /espace-user");

    }else{
        die("Le formulaire est incomplet");
    }
}
?>